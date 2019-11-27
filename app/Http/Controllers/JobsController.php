<?php


namespace App\Http\Controllers;

define('gdp', 'GWD GDP Section');
define('modem', 'GWD Modem Section');
define('bbp', 'GWD Battery BullPlug');
define('na', 'Not assigned');

use App\Battery;
use App\Job;
use App\Tool;
use App\Engineer;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $batteries = Battery::where('condition', 1)->get();
        $engineers = Engineer::all();
        $tools = Tool::where('tool_type', gdp)->get();
        $modems = Tool::where('tool_type', modem)->get();
        $bbps = Tool::where('tool_type', bbp)->get();

        return view('jobs/create', compact(
                            'batteries','engineers', 'tools',
                            'modems', 'bbps'));
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
        $job_number = request('jobNumber');
        $toolNum = request('toolNumber');
        $modemNum = request('modemNumber');
        $bbpNum = request('bbpNumber');
        $tool_circHrs = request('toolCircHrs');
        $battery = request('battery');

        $job = Job::create($this->validatedData());

        if (request()->has('battery')){
            $battery_find = Battery::where('id', $battery)->first();
            $job->battery()->save($battery_find);
            $this->changBatStatus($battery_find->id, $job_number);
        }

        $this->calcCircHrsTool($toolNum, $tool_circHrs);
        $this->calcCircHrsTool($modemNum, $tool_circHrs);
        $this->calcCircHrsTool($bbpNum, $tool_circHrs);

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
            $battery_id = $job->battery->id;
            $battery_serialOne = $job->battery->serialOne;
        }

        return view('jobs.edit', compact('job', 'tools',
                                    'modems', 'bbps', 'batteries',
                                    'engineers', 'battery_id', 'battery_serialOne'));
    }

    public function update(Job $job)
    {
        $job_old = $job->toolCircHrs;
        $job_new = request('toolCircHrs');
        $gdp = request('toolNumber');
        $mod = request('modemNumber');
        $bbp = request('bbpNumber');

        //tool
        $tool = Tool::where('tool_number', $gdp)->first();
        $tool_number = $tool->tool_number;
        $tool_circ_current = $tool->tool_circHrs;

        //modem
        $modem = Tool::where('tool_number', $mod)->first();
        $modem_number = $modem->tool_number;
        $modem_circ_current = $modem->tool_circHrs;

        //bbp
        $bbp = Tool::where('tool_number', $bbp)->first();
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
        $tool = Tool::where('tool_number', $tool_number)->first();

        $tool_current_circHrs = $tool->tool_circHrs;

        $tool_total_circHrs = $tool_current_circHrs + $tool_circHrs;

        $tool->tool_circHrs = $tool_total_circHrs;

        $tool->save();
    }

    private function changBatStatus($batt_id, $jobNumber)
    {
        $battery = Battery::where('id', $batt_id)->first();

        $battery->condition = 0;    //0 - USED, 1 - NEW

        $battery->job_assigned = $jobNumber;

        $battery->save();
    }

    public function circDiff($tool_number, $tool_circ_current, $job_old, $job_new)
    {
        $tool = Tool::where('tool_number', $tool_number)->first();

        $tool_circ_total = ($job_new - $job_old) + $tool_circ_current;

        $tool->tool_circHrs = $tool_circ_total;

        $tool->save();

    }

    protected function validatedData()
    {
        return request()->validate([
            'jobNumber' => 'required|unique:jobs',
            'toolNumber' => 'nullable',
            'modemNumber' => 'nullable',
            'bbpNumber' => 'nullable',
            'engFirst' => 'nullable',
            'engSecond' => 'nullable',
            'eng1ArrRig' => 'nullable',
            'eng2ArrRig' => 'nullable',
            'eng1DepRig' => 'nullable',
            'eng2DepRig' => 'nullable',
            'container' => 'nullable',
            'containerArrRig' => 'nullable',
            'containerDepRig' => 'nullable',
            'toolCircHrs' => 'nullable|numeric',
            'comment' => 'nullable',
        ]);
    }
}
