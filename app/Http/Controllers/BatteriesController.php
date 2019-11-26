<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatteriesController extends Controller
{
    public function index()
    {
        $jobs = \App\Job::all();
        $batteries = \App\Battery::all();

        return view('batteries/index', compact('batteries', 'jobs'));
    }

    public function create()
    {
        return view('batteries/addbattery');
    }
    public function store()
    {

        $data = request()->validate([
            'serialOne' => 'required',
            'condition' => 'required',
        ]);
        $battery = new \App\Battery();
        $battery->serialOne = request('serialOne');
        $battery->serialTwo = request('serialTwo');
        $battery->serialThree = request('serialThree');
        $battery->date = request('date');
        $battery->condition = request('condition');
        $battery->container = request('container');
        $battery->comment = request('comment');
        $battery->save();

        return redirect('/batteries');
    }
}
