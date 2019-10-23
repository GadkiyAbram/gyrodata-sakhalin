<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = \App\Job::all();
        return view('jobs.index', compact('jobs'));
    }
    public function addJob()
    {
        $batteries = \App\Battery::all();

        return view('jobs/addjob', compact('batteries'));
    }
    public function store()
    {
        $data = request()->validate([
            'jobNumber' => 'required',
        ]);
        $job = new \App\Job();
        $job->jobNumber = request('jobNumber');
        $job->toolNumber = request('toolNumber');
        $job->modemNumber = request('modemNumber');
        $job->bbpNumber = request('bbpNumber');
        $job->firstEng = request('firstEng');
        $job->secondEng = request('secondEng');
        $job->eng1ArrRig = request('eng1ArrRig');
        $job->eng2ArrRig = request('eng2ArrRig');
        $job->eng1DepRig = request('eng1DepRig');
        $job->eng2DepRig = request('eng2DepRig');
        $job->container = request('container');
        $job->containerArrRig = request('containerArrRig');
        $job->containerDepRig = request('containerDepRig');
        $job->toolCircHrs = request('toolCircHrs');
        $job->comment = request('comment');
        $job->save();
        return redirect('/jobs');
    }
}
