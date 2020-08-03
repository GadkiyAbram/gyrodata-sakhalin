<?php

namespace App\Http\Controllers;
use App\Client;
use App\Http\Component;
use Illuminate\Http\Request;
use DB;

define('gdp', 'GDP Section');
define('modem', 'GWD Modem');
define('bbp', 'GWD Bullplug');
define('na', 'Not assigned');

class JobsController extends Controller
{
    private $job_numbers = [];

//    private $dataForJobCreate;      // Data for Job create (gdp / modems / batteries etc)

    public function index()
    {
        return view('jobs.index');
    }

    public function searchJobs(Request $request)
    {
        $what = $request->search_data;
        $where = $request->search_where;

        $jobs = $this->getJobData($what, $where);

        return view('jobs.data', compact('jobs'));
    }

    public function getJobData($what, $where)
    {
        $service = ('JobsAll');
        $uri = APIHelper::getUrl($service). "?what=" . $what . "&where=" . $where;
        return APIHelper::getRecord($uri);
    }

    private function getDataForNewJob($uri)
    {
        return APIHelper::getRecord($uri);
    }

    public function create()
    {
        $uri = APIHelper::getUrl('DataForJob');

        $data = $this->getDataForNewJob($uri);
        $gdps = $data[1];                       // GDP Sections
        $modems = $data[2];                     // Modems
        $bbps = $data[3];                       // Bullplugs
        $clients = $data[0];                    // clients
        $batteries = $data[5];                  // batteries
        $engineers = $data[4];                  // engineers

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
        $service = 'JobCustom';
        $uri = APIHelper::getUrl($service) . $jobnumber;
        return (array)(APIHelper::getRecord($uri)[0]);
    }

    public function store()
    {
        $service = 'JobAdd';
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

        $uri = APIHelper::getUrl($service);
        $job_id = APIHelper::insertRecord($uri, $data);
        return redirect('/jobs');
    }

    public function edit($job)
    {
        $uri = APIHelper::getUrl('DataForJob');
        $dataForJob = $this->getDataForNewJob($uri);
        // search item by Id and pass to compact
        $job = $this->getJob($job);
        $clients = $dataForJob[0];
        $gdps = $dataForJob[1];
        $modems = $dataForJob[2];
        $bbps = $dataForJob[3];
        $batteries = $dataForJob[5];
        $engineers = $dataForJob[4];

        return view('jobs.edit', compact('job',
            'batteries','engineers', 'gdps',
            'modems', 'bbps', 'clients'));
    }

    public function update($id)
    {
        $service = 'JobEdit';
        $uri = APIHelper::getUrl($service) . $id;
        $data = [
            'Id' => $id,
            'JobNumber' => request('JobNumber'),
            'ClientName' => request('ClientName'),
            'GDP' => request('GDP'),
            'Modem' => request('Modem'),
            'ModemVersion' => request('ModemVersion'),
            'Bullplug' => request('Bullplug'),
            'Battery' => request('Battery'),
            'CirculationHours' => request('CirculationHours'),
            'MaxTemp' => request('MaxTemp'),
            'EngineerOne' => request('EngineerOne'),
            'EngineerTwo' => request('EngineerTwo'),
            'eng_one_arrived' => request('eng_one_arrived'),
            'eng_two_arrived' => request('eng_two_arrived'),
            'eng_one_left' => request('eng_one_left'),
            'eng_two_left' => request('eng_two_left'),
            'Container' => request('Container'),
            'ContainerArrived' => request('ContainerArrived'),
            'ContainerLeft' => request('ContainerLeft'),
            'Issues' => request('Issues'),
            'Rig' => request('Rig'),
            'Comment' => request('Comment')
        ];
        APIHelper::updateRecord($uri, $data);
        return redirect('/jobs');
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
