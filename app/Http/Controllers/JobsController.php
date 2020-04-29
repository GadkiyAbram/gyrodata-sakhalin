<?php

namespace App\Http\Controllers;
use App\Client;
use App\Http\Component;
use \App\Item;
use DB;

define('gdp', 'GDP Section');
define('modem', 'GWD Modem');
define('bbp', 'GWD Bullplug');
define('na', 'Not assigned');

use App\Battery;
use App\Job;
use App\Tool;
use App\Engineer;
use GuzzleHttp\Psr7\Request;

class JobsController extends Controller
{
    private $job_numbers = [];

    private $dataForJobCreate;      // Data for Job create (gdp / modems / batteries etc)

    public function index()
    {
        $uri = APIHelper::getUrl('JobsAll'). "?what=&where=";
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $jobs = json_decode((string)$response->getBody());
            $jobs = (array)$jobs;
            foreach ($jobs as $job)
            {
                array_push($this->job_numbers, $job->JobNumber);
            }
        }catch (\Exception $ex){
            dd($ex);
        }
        return view('jobs.index', compact('jobs'));
    }

    private function getDataForNewJob($uri, $token)
    {
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $this->dataForJobCreate = json_decode((string)$response->getBody());
            $this->dataForJobCreate = (array)$this->dataForJobCreate;
        }catch (\Exception $ex){
            dd($ex);
        }

        return $this->dataForJobCreate;
    }

    public function create()
    {
        $uri = APIHelper::getUrl('DataForJob');
        $token = session()->get('Token');

        $data = $this->getDataForNewJob($uri, $token);
        $gdps = $data[1];
        $modems = $data[2];
        $bbps = $data[3];
        $clients = $data[0];
        $batteries = $data[5];
        $engineers = $data[4];

        return view('jobs/create', compact(
                            'batteries','engineers', 'gdps',
                            'modems', 'bbps', 'clients'));
    }

    public function show($job)
    {
        $job = $this->getJob($job);

        return view('jobs.show', compact('job'));
    }

    public function getJob($jobnumber)
    {
        $uriGetSelectedJob = 'http://192.168.0.102:8081/jobservices/jobservice.svc/GetSelectedJobData/' . $jobnumber;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uriGetSelectedJob]);
        try {
            $response = $client->get($uriGetSelectedJob, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $job = json_decode((string)$response->getBody());
            $job = (array)$job[0];

        } catch (\Exception $ex) {
            dd($ex);
        }
        return $job;
    }

    public function store()
    {
        $uri = 'http://192.168.0.102:8081/jobservices/jobservice.svc/AddNewJob';
        $data = [
            'JobNumber' => request('JobNumber'),
            'ClientName' => request('client_id'),
            'GDP' => request('gdp_id'),
            'Modem' => request('modem_id'),
            'ModemVersion' => request('ModemVersion'),
            'MaxTemp' => request('MaxTemp'),
            'Bullplug' => request('bullplug_id'),
            'Battery' => request('battery_id'),
            'EngineerOne' => request('eng_one'),
            'EngineerTwo' => request('eng_two'),
            'eng_one_arrived' => request('eng_one_arrived'),
            'eng_two_arrived' => request('eng_two_arrived'),
            'eng_one_left' => request('eng_one_left'),
            'eng_two_left' => request('eng_two_left'),
            'Container' => request('Container'),
            'ContainerArrived' => request('ContainerArrived'),
            'ContainerLeft' => request('ContainerLeft'),
            'Rig' => request('Rig'),
            'Issues' => request('Issues'),
            'Comment' => request('Comment')
        ];

        $job_id = APIHelper::insertRecord($uri, $data);

        return redirect('/jobs');
    }

    public function edit($job)
    {
        $uriDataForJob = APIHelper::getUrl('DataForJob');
        $token = session()->get('Token');
        // search item by Id and pass to compact
        $job = $this->getJob($job);
        $dataForJob = $this->getDataForNewJob($uriDataForJob, $token);
        $engineers = $dataForJob[4];

        return view('jobs.edit', compact('job', 'engineers'));
    }

    public function update(Job $job)
    {

        $job_old = $job->toolCircHrs;
        $job_new = request('CirculationHours');
        $gdp = request('gdp_id');
        $mod = request('modem_id');
        $bbp = request('bullplug_id');

        //tool
        $tool = Tool::where('Asset', $gdp)->first();
        $tool_number = $tool->tool_number;
        $tool_circ_current = $tool->tool_circHrs;

        //modem
        $modem = Tool::where('Asset', $mod)->first();
        $modem_number = $modem->tool_number;
        $modem_circ_current = $modem->tool_circHrs;

        //bbp
        $bbp = Tool::where('Asset', $bbp)->first();
        $bbp_number = $bbp->tool_number;
        $bbp_circ_current = $bbp->tool_circHrs;

        $job->update($this->validatedData());

        $this->circDiff($tool_number, $tool_circ_current, $job_old, $job_new);
        $this->circDiff($modem_number, $modem_circ_current, $job_old, $job_new);
        $this->circDiff($bbp_number, $bbp_circ_current, $job_old, $job_new);

        return redirect('/jobs');
    }

    private function calcCircHrsTool($tool_number, $tool_circHrs)
    {
        $tool = Component::where('Asset', $tool_number)->first();

        $tool_current_circHrs = $tool->tool_circHrs;

        $tool_total_circHrs = $tool_current_circHrs + $tool_circHrs;

        $tool->tool_circHrs = $tool_total_circHrs;

        $tool->save();
    }

    private function changBatStatus($batt_id, $jobNumber)
    {
        $battery = Battery::where('Id', $batt_id)->first();

        $battery->BatteryCondition = 'Used';    //0 - USED, 1 - NEW

//        $battery->job_assigned = $jobNumber;

        $battery->save();
    }

    public function circDiff($tool_number, $tool_circ_current, $job_old, $job_new)
    {
        $tool = Component::where('Asset', $tool_number)->first();

        $tool_circ_total = ($job_new - $job_old) + $tool_circ_current;

        $tool->tool_circHrs = $tool_circ_total;

        $tool->save();

    }

    protected function validatedData()
    {
        return request()->validate([
            'JobNumber' => 'required|unique:jobs',
            'gdp_id' => 'nullable',
            'modem_id' => 'nullable',
            'bullplug_id' => 'nullable',
            'battery_id' => 'nullable',
//            'eng_one' => 'nullable',
//            'eng_two' => 'nullable',
//            'eng_one_arrived' => 'nullable',
//            'eng_two_arrived' => 'nullable',
//            'eng_one_left' => 'nullable',
//            'eng_two_left' => 'nullable',
//            'Container' => 'nullable',
//            'ContainerArrived' => 'nullable',
//            'ContainerLeft' => 'nullable',
//            'CirculationHours' => 'nullable|numeric',
//            'Comment' => 'nullable',
        ]);
    }
}
