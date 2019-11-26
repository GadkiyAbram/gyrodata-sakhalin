<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Tool;
use \App\Item;
use Intervention\Image\Facades\Image;

class ToolsController extends Controller
{
    public function index()
    {
        $tools = Tool::all();

        return view('tools.index', compact('tools'));
    }

    public function create()
    {
        $items = Item::all();

        return view('tools/create', compact('items'));
    }

    public function store()
    {
        $tool = Tool::create($this->validatedData());

        $this->storeImage($tool);

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

    private function validatedData()
    {
        return tap(request()->validate([
            'tool_type' => 'required',
            'tool_number' => 'required',
            'tool_arrived' => 'nullable|date',
            'tool_demob' => 'nullable|date',
            'tool_invoice' => 'nullable',
            'tool_ccd' => 'nullable',
            'tool_desc_rus' => 'nullable',
            'tool_ccd_pos' => 'nullable',
            'tool_location' => 'nullable',
            'tool_last_rt' => 'nullable',
            'tool_comment' => 'nullable',
        ]), function () {
            if (request()->hasFile('image')){
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });
    }
    public function storeImage($tool)
    {
        if (request()->has('image')){
            $tool->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $tool->image));
            if ($image->getWidth() < $image->getHeight()){
                $image->rotate(90);

            }
            $image->fit(650, 400);
            $image->save();
        }
    }
}
