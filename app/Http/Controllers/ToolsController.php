<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function index()
    {
        $tools = \App\Tool::all();

        return view('tools.index', compact('tools'));
    }

    public function addTool()
    {
        return view('tools/addtool');
    }

    public function store()
    {
        $data = request()->validate([
            'tool_type' => 'required',
            'tool_number' => 'required',
        ]);

        $tool = new \App\Tool();
        $tool->tool_type = request('tool_type');
        $tool->tool_number = request('tool_number');
        $tool->tool_arrived = request('tool_arrived');
        $tool->tool_demob = request('tool_demob');
        $tool->tool_invoice = request('tool_invoice');
        $tool->tool_ccd = request('tool_ccd');
        $tool->tool_desc_rus = request('tool_desc_rus');
        $tool->tool_ccd_pos = request('tool_ccd_pos');
        $tool->tool_location = request('tool_location');
        $tool->tool_comment = request('tool_comment');
        $tool->save();

        return redirect('/tools');
    }


}
