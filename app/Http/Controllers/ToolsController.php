<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

define('GDP', 'GDP Sections');
define('MODEM', 'GWD Modem');
define('BBP', 'GWD Bullplug');

class ToolsController extends Controller
{
    public function index()
    {
        return view('tools.index');
    }

    public function searchItems(Request $request)
    {
        $what = $request->search_data;
        $where = $request->search_where;

        //TODO - refactor, rmeove if-else struct
        if (empty($request->search_data))
        {
            $items = $this->getToolData('', '');
        }else
        {
            $items = $this->getToolData($what, $where);
        }

        return view('tools.data', compact('items'));
    }

    public function getToolData($what, $where)
    {
        return APIHelper::getToolData($what, $where);
    }

    public function create()
    {
        $uri = APIHelper::getUrl('ToolItems');
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $components = json_decode((string)$response->getBody());
            $components = (array)$components;
        }catch (\Exception $ex){
            dd($ex);
        }
        return view('tools/create', compact('components'));
    }

    public function store()
    {
        $uri = 'http://192.168.0.102:8081/toolservices/toolservice.svc/AddNewItem';
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        $data = [
            'Item' => request('Item'),
            'Asset' => request('Asset'),
            'Arrived' => request('Arrived'),
            'Invoice' => request('Invoice'),
            'CCD' => request('CCD'),
            'NameRus' => request('NameRus'),
            'PositionCCD' => request('PositionCCD'),
            'ItemStatus' => request('ItemStatus'),
            'Box' => request('Box'),
            'Container' => request('Container'),
            'ItemImage' => base64_encode(file_get_contents(request(('image')))),
            'Comment' => request('Comment')
        ];
//        dd($data);
        try{
            $response = $client->post($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ],
                'body' => json_encode($data)
            ]);
            $tool_id = json_decode((string)$response->getBody());
        }catch (\Exception $ex){
            dd($ex);
        }
        return redirect('/tools');
    }

    public function getJobsInvolvedIn($id)
    {
        $uri = 'http://192.168.0.102:8081/toolservices/toolservice.svc/GetJobsInvolvedIn?item=' . $id;
        $token = session()->get('Token');

        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $jobsInvolvedIn = json_decode((string)$response->getBody());
            $jobsInvolvedIn = (array)$jobsInvolvedIn;

        }catch (\Exception $ex){
            dd($ex);
        }
//        dd($jobsInvolvedIn);
        return $jobsInvolvedIn;
    }

    public function show($tool)
    {
        $item = $this->getItem($tool);
        $circulation = $this->getCirculation($item);
        $jobs = $this->getJobsInvolvedIn($item['Id']);
        $jobs = (array)$jobs;
//        $itemimage = imagecreatefromstring(base64_decode($item['ItemImage']));

        // TODO - add jobs where Tool involved
//        $tool = Item::find($tool);
//        switch ($tool->Item){
//            case 'GDP Sections':
//                $jobs_involved = Job::where('toolNumber', $tool->Asset)->get();
//                break;
//            case 'GWD Modem Section':
//                $jobs_involved = Job::where('modemNumber', $tool->Asset)->get();
//                break;
//            case 'GWD Battery BullPlug':
//                $jobs_involved = Job::where('bbpNumber', $tool->Asset)->get();
//                break;
//        }
//        dd($jobs);
        return view('tools.show', compact('item', 'circulation', 'jobs'));
    }

    private function getCirculation($item)
    {
        if ($item['Item'] == GDP || $item['Item'] == MODEM || $item['Item'] == BBP)
        {
            $circulation = $item['Circulation'];
        }else
        {
            $circulation = 'N/A';
        }
        return $circulation;
    }

    public function edit($id)
    {
        // search item by Id and pass to compact
        $item = $this->getItem($id);
        if ($this->getCirculation($item) != 'N/A')
        {
            $circulation_remains = 500 - $this->getCirculation($item);
        }else
        {
            $circulation_remains = 'N/A';
        }

        return view('tools.edit', compact('item', 'circulation_remains'));
    }

    public function update($id)
    {
        $uri = 'http://192.168.0.102:8081/toolservices/toolservice.svc/EditItem/' . $id;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        $data = [
            'Id' => $id,
//            'Item' => request('Item'),
            'Item' => $this->getItem($id)['Item'],      //  refactor this, place it as local var!!
            'Asset' => request('Asset'),
            'Arrived' => request('Arrived'),
            'Invoice' => request('Invoice'),
            'CCD' => request('CCD'),
            'NameRus' => request('NameRus'),
            'PositionCCD' => request('PositionCCD'),
            'ItemStatus' => request('ItemStatus'),
            'Box' => request('Box'),
            'Container' => request('Container'),
            'ItemImage' => base64_encode(file_get_contents(request(('image')))),
            'Comment' => request('Comment')
        ];
//        dd($data);
        try{
            $response = $client->post($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ],
                'body' => json_encode($data)
            ]);
        }catch (\Exception $ex){
            dd($ex);
        }
        return redirect('/tools');
    }

    private function validatedData()
    {
        return tap(request()->validate([
            'Item' => 'required',
            'Asset' => 'required',
            'Arrived' => 'nullable|date',
            'Invoice' => 'nullable',
            'CCD' => 'nullable',
//            'tool_desc_rus' => 'nullable',
            'PositionCCD' => 'nullable',
            'ItemStatus' => 'nullable',
            'Box' => 'nullable',
            'Comment' => 'nullable',
        ]), function () {
            if (request()->hasFile('image')){
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });
    }
//    public function storeImage($tool)
//    {
//        if (request()->has('image')){
//            $tool->update([
//                'image' => request()->image->store('uploads', 'public'),
//            ]);
//
//            $image = Image::make(public_path('storage/' . $tool->image));
//            if ($image->getWidth() < $image->getHeight()){
//                $image->rotate(90);
//            }
//            $image->fit(650, 400);
//            $image->save();
//        }
//    }

    public function getItem($id)
    {
//        $uri = APIHelper::getUrl('ToolCustom'). $id;
        $uri = 'http://192.168.0.102:8081/toolservices/toolservice.svc/GetSelectedItemLRL?item=' . $id;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $item = json_decode((string)$response->getBody());
            $item = (array)$item[0];

        }catch (\Exception $ex){
            dd($ex);
        }
//        dd($token);
//        dd($data);
        return $item;
    }
}
