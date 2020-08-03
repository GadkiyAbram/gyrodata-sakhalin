<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CCDController extends Controller
{
    public function index()
    {
        return view('ccd.index');
    }

//    public function usession(Request $request){
//        $request->session()->flash('Name', 'GadkiyAbram');
//    }
}