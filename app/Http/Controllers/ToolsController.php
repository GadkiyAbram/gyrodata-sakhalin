<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Tool;
use \App\Item;

class ToolsController extends Controller
{
    public function index()
    {
        $tools = \App\Tool::all();

        return view('tools.index', compact('tools'));
    }

    public function addTool()
    {
        $items = \App\Item::all();

        return view('tools/addtool', compact('items'));
    }

    public function store()
    {
        $data = request()->validate([
            'tool_type' => 'required',
            'tool_number' => 'required',
            'tool_arrived' => 'nullable|date',
            'tool_demob' => 'nullable|date',
            'tool_invoice' => 'nullable',
            'tool_ccd' => 'nullable',
            'tool_desc_rus' => 'nullable',
            'tool_ccd_pos' => 'nullable',
            'tool_location' => 'nullable',
            'tool_comment' => 'nullable',
        ]);

        \App\Tool::create($data);

//        $tool = new \App\Tool();
//        $tool->tool_type = request('tool_type');
//
//        $tool->tool_number = request('tool_number');
//        $tool->tool_arrived = request('tool_arrived');
//        $tool->tool_demob = request('tool_demob');
//        $tool->tool_invoice = request('tool_invoice');
//        $tool->tool_ccd = request('tool_ccd');
//        $tool->tool_desc_rus = request('tool_desc_rus');
//        $tool->tool_ccd_pos = request('tool_ccd_pos');
//        $tool->tool_location = request('tool_location');
//        $tool->tool_comment = request('tool_comment');
//        $tool->save();

        //Calculating Tool quantity
        $toolType = request('tool_type');
        $item = Item::where('name', $toolType)->first();
        $item->quantity += 1;
        $item->save();


        return redirect('/tools');
    }

    public function show($tool)
    {
        $tool = Tool::find($tool);
        switch ($tool->tool_type){
            case 'GWD GDP Section':
                $jobs_involved = Job::where('toolNumber', $tool->tool_number)->get();
                break;
            case 'GWD Modem Section':
                $jobs_involved = Job::where('modemNumber', $tool->tool_number)->get();
                break;
            case 'GWD Battery BullPlug':
                $jobs_involved = Job::where('bbpNumber', $tool->tool_number)->get();
                break;
        }

        $circ_remains = 500 - $tool->tool_circHrs;

        return view('tools.show', compact('tool',
            'jobs_involved',
            'circ_remains'));
    }

}
