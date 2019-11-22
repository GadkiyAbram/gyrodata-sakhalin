<?php

namespace App\Http\Controllers;

use App\Job;
use App\Tool;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
//        $jobs = \App\Job::with('engineer');
//        dd($jobs);
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

        $job->battery_id = request('battery');
        $batt_id = request('battery');

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

        $this->calcCircHrsTool($toolNum, $tool_circHrs);
        $this->calcCircHrsTool($modemNum, $tool_circHrs);
        $this->calcCircHrsTool($bbpNum, $tool_circHrs);
        $this->changBatStatus($batt_id, $job_number);

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

        $battery->condition = 0;    //0 - USED, 1 - NEW

        $battery->job_assigned = $jobNumber;

        $battery->save();
    }
}
