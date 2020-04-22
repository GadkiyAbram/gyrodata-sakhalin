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
//            dd($this->job_numbers);
        }catch (\Exception $ex){
            dd($ex);
        }

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $gdps = Item::where('Item', gdp)->get();
        $modems = Item::where('Item', modem)->get();
        $bbps = Item::where('Item', bbp)->get();
        $clients = Client::all();
        $batteries = Battery::where('BatteryCondition', 'New')->get();
        $engineers = Engineer::all();

        return view('jobs/create', compact(
                            'batteries','engineers', 'gdps',
                            'modems', 'bbps', 'clients'));
    }

    public function show($job)
    {
        $job = Job::find($job);

//        $battery_id = $job->battery->id;
//        $battery_serialOne = $job->battery->serialOne;

        if ($job->battery === null){
            $battery_id = na;
            $battery_serialOne = na;
        }else{
            $battery_id = $job->battery->id;
            $battery_serialOne = $job->battery->serialOne;
        }

        return view('jobs.show', compact('job', 'battery_id', 'battery_serialOne'));
    }

    public function store()
    {
        $jobNumber = request('JobNumber');
        $client = request('client_id');
        $gdp = request('gdp_id');
        $modem = request('modem_id');
        $bbp = request('bullplug_id');
        $circHrs = request('CirculationHours');
        $battery = request('battery_id');
        $eng_one = request('eng_one');
        $eng_two = request('eng_two');


//        dd($jobNumber, $client, $gdp, $modem, $circHrs, $battery, $eng_one, $eng_two);

        DB::select("EXEC spJob_Insert ?,?,?,?,?,?,?,?,?",
                        array( $jobNumber,
                            $client,
                            $gdp, $modem,
                                $bbp, $circHrs, $battery, $eng_one, $eng_two) );

//        dd($result);

//        DB::select(DB::raw("exec spJob_Insert :JobNumber,
//                                                :GDPAsset,
//                                                :ModemAsset,
//                                                :BullplugAsset,
//                                                :CirculationHours,
//                                                :Battery\"),[
//                            ':JobNumber' => $job_number,
//                            ':GDPAsset' => $toolNum,
//                            ':ModemAsset' => $modemNum,
//                            ':BullplugAsset' => $bbpNum,
//                            ':CirculationHours' => $tool_circHrs,
//                            ':Battery' => $battery,
//                        ]);"));

//        $job = Job::create($this->validatedData());
//
//        if (request()->has('battery_id')){
//            $battery_find = Battery::where('Id', $battery)->first();
//            $job->battery()->save($battery_find);
//            $this->changBatStatus($battery_find->Id, $job_number);
//        }
//
//        $this->calcCircHrsTool($toolNum, $tool_circHrs);
//        $this->calcCircHrsTool($modemNum, $tool_circHrs);
//        $this->calcCircHrsTool($bbpNum, $tool_circHrs);

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        $tools = Tool::where('tool_type', gdp)->get();
        $modems = Tool::where('tool_type', modem)->get();
        $bbps = Tool::where('tool_type', bbp)->get();
        $batteries = Battery::where('condition', 1)->get();
        $engineers = Engineer::all();

        if ($job->battery === null){
            $battery_id = na;
            $battery_serialOne = na;
        }else{
            $battery_id = $job->battery->Id;
            $battery_serialOne = $job->battery->serialOne;
        }

        return view('jobs.edit', compact('job', 'tools',
                                    'modems', 'bbps', 'batteries',
                                    'engineers', 'battery_id', 'battery_serialOne'));
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
