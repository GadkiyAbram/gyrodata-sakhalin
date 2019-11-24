<?php

namespace App\Http\Controllers;

use App\Battery;
use App\Job;
use App\Tool;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function addJob()
    {
        $gdp = 'GWD GDP Section';
        $modem = 'GWD Modem Section';
        $bbp = 'GWD Battery BullPlug';

        $batteries = \App\Battery::where('condition', 1)->get();
        $engineers = \App\Engineer::all();
        $tools = Tool::where('tool_type', $gdp)->get();
        $modems = Tool::where('tool_type', $modem)->get();
        $bbps = Tool::where('tool_type', $bbp)->get();

        return view('jobs/addjob', compact(
                            'batteries','engineers', 'tools',
                            'modems', 'bbps'));
    }

    public function show($job)
    {
        $job = Job::find($job);

        return view('jobs.show', compact('job'));
    }

    public function store()
    {
        $data = request()->validate([
            'jobNumber' => 'required',
        ]);
        $job = new \App\Job();
        $job->jobNumber = request('jobNumber');
        $job_number = $job->jobNumber;

        $job->toolNumber = request('toolNumber');
        $toolNum = $job->toolNumber;

        $job->modemNumber = request('modemNumber');
        $modemNum = $job->modemNumber;

        $job->bbpNumber = request('bbpNumber');
        $bbpNum = $job->bbpNumber;

//        $job->battery_id = request('battery');
//        $batt_id = request('battery');
        $battery = request('battery');

        $job->engFirst = request('firstEng');
        $job->engSecond = request('secondEng');
        $job->eng1ArrRig = request('eng1ArrRig');
        $job->eng2ArrRig = request('eng2ArrRig');
        $job->eng1DepRig = request('eng1DepRig');
        $job->eng2DepRig = request('eng2DepRig');
        $job->container = request('container');
        $job->containerArrRig = request('containerArrRig');
        $job->containerDepRig = request('containerDepRig');
        $job->toolCircHrs = request('toolCircHrs');

//        $tool_circHrs = $job->toolCircHrs;
        $tool_circHrs = request('toolCircHrs');

        $job->comment = request('comment');
        $job->save();

        $battery_find = Battery::where('id', $battery)->first();
//        dd($battery_find->id);
        $job->battery()->save($battery_find);

        $this->calcCircHrsTool($toolNum, $tool_circHrs);
        $this->calcCircHrsTool($modemNum, $tool_circHrs);
        $this->calcCircHrsTool($bbpNum, $tool_circHrs);
        $this->changBatStatus($battery_find->id, $job_number);

        return redirect('/jobs');
    }

    public function editJob(Job $job)
    {
        $gdp = 'GWD GDP Section';
        $modem = 'GWD Modem Section';
        $bbp = 'GWD Battery BullPlug';

        $tools = Tool::where('tool_type', $gdp)->get();
        $modems = Tool::where('tool_type', $modem)->get();
        $bbps = Tool::where('tool_type', $bbp)->get();
        $engineers = \App\Engineer::all();

        return view('jobs.editjob', compact('job', 'tools',
                                                    'modems', 'bbps', 'engineers'));
    }

    public function update(Job $job)
    {
        //tool
        $tool = \App\Tool::where('tool_number', request('toolNumber'))->first();
        $tool_number = $tool->tool_number;
        $tool_circ_current = $tool->tool_circHrs;

        //modem
        $modem = \App\Tool::where('tool_number', request('modemNumber'))->first();
        $modem_number = $modem->tool_number;
        $modem_circ_current = $modem->tool_circHrs;

        //bbp
        $bbp = \App\Tool::where('tool_number', request('bbpNumber'))->first();
        $bbp_number = $bbp->tool_number;
        $bbp_circ_current = $bbp->tool_circHrs;

        $job_old = $job->toolCircHrs;
        $job_new = request('toolCircHrs');

        $data = request()->validate([
            'jobNumber' => 'required',
            'toolNumber' => 'required',
            'modemNumber' => 'required',
            'bbpNumber' => 'required',
            'engFirst' => 'nullable',
            'engSecond' => 'nullable',
            'eng1ArrRig' => 'nullable',
            'eng2ArrRig' => 'nullable',
            'eng1DepRig' => 'nullable',
            'eng2DepRig' => 'nullable',
            'container' => 'nullable',
            'containerArrRig' => 'nullable',
            'containerDepRig' => 'nullable',
            'toolCircHrs' => 'nullable',
            'comment' => 'nullable',

        ]);
//        $job->jobNumber = request('jobNumber');
//        $job->toolNumber = request('toolNumber');
//        $job->modemNumber = request('modemNumber');
//        $job->bbpNumber = request('bbpNumber');
//        $job->engFirst = request('firstEng');
//        $job->engSecond = request('secondEng');
//        $job->eng1ArrRig = request('eng1ArrRig');
//        $job->eng2ArrRig = request('eng2ArrRig');
//        $job->eng1DepRig = request('eng1DepRig');
//        $job->eng2DepRig = request('eng2DepRig');
//        $job->container = request('container');
//        $job->containerArrRig = request('containerArrRig');
//        $job->containerDepRig = request('containerDepRig');
//        $job->toolCircHrs = request('toolCircHrs');
//        $job->comment = request('comment');
        $job->update($data);

        $this->circDiff($tool_number, $tool_circ_current, $job_old, $job_new);
        $this->circDiff($modem_number, $modem_circ_current, $job_old, $job_new);
        $this->circDiff($bbp_number, $bbp_circ_current, $job_old, $job_new);

        return redirect('/jobs');
    }

    private function calcCircHrsTool($tool_number, $tool_circHrs)
    {
        $tool = \App\Tool::where('tool_number', $tool_number)->first();

        $tool_current_circHrs = $tool->tool_circHrs;

        $tool_total_circHrs = $tool_current_circHrs + $tool_circHrs;

        $tool->tool_circHrs = $tool_total_circHrs;

        $tool->save();
    }

    private function changBatStatus($batt_id, $jobNumber)
    {
        $battery = \App\Battery::where('id', $batt_id)->first();
//        dd($battery->serialOne, $battery->id, $battery->condition);

        $battery->condition = 0;    //0 - USED, 1 - NEW

        $battery->job_assigned = $jobNumber;

//        $data = [
//            'condition' => $battery->condition,
//            'job_assigned' => $battery->job_assigned,
//        ];

//        $battery->save($data);

        $battery->save();
    }

    public function circDiff($tool_number, $tool_circ_current, $job_old, $job_new)
    {
        $tool = \App\Tool::where('tool_number', $tool_number)->first();

        $tool_circ_total = ($job_new - $job_old) + $tool_circ_current;

        $tool->tool_circHrs = $tool_circ_total;

//        dd($tool_circ_current, $tool_circ_total);


        $tool->save();

    }
}
