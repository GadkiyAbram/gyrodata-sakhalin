<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidItem;

define('GDP', 'GDP Sections');
define('MODEM', 'GWD Modem');
define('BBP', 'GWD Bullplug');

class ToolsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tools.index');
    }

    public function searchItems(Request $request)
    {
        $what = $request->search_data;
        $where = $request->search_where;

        $items = $this->getToolData($what, $where);

        return view('tools.data', compact('items'));
    }

    public function getToolData($what, $where)
    {
        $service = 'ToolsAll';
        $uri = APIHelper::getUrl($service). "?what=" . $what . "&where=" . $where;
        return APIHelper::getRecord($uri);
    }

    public function create()
    {
        $service = 'ToolItems';
        $components = APIHelper::getComponentsForTools($service);

        return view('tools/create', compact('components'));
    }

    public function store()
    {
        $this->validatedData();

        $service = 'ToolAdd';
        $uri = APIHelper::getUrl($service);
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
//            'ItemImage' => base64_encode(file_get_contents(request(('image')))),
            'Comment' => request('Comment')
        ];

        if (request()->hasFile('image'))
        {
            $imageArray = array('ItemImage' => base64_encode(file_get_contents(request(('image')))));
            $data = array_merge($data, $imageArray);
        }

//         if (count($this->getItemItemAsset(request('Item'), request('Asset'))) == 0)
//         {
//             $item_id = APIHelper::insertRecord($uri, $data);
//             return redirect('/tools');
//         }else
//         {
            
//         }
        $item_id = APIHelper::insertRecord($uri, $data);
        return redirect('/tools');
    }

    private function validatedData()
    {
        return tap(request()->validate([
            'Item' => 'required',
//             'Asset' => 'required',
            'Asset' => ['required', new ValidItem(request('Item'), request('Asset'))],
            'Arrived' => 'nullable|date',
            'Invoice' => 'nullable',
            'CCD' => 'nullable',
            'NameRus' => 'nullable',
            'PositionCCD' => 'nullable',
            'ItemStatus' => 'nullable',
            'Box' => 'nullable',
            'image' => 'nullable',
            'Comment' => 'nullable',
        ]), function () {
            if (request()->hasFile('image')){
                request()->validate([
                    'image' => 'file|image|max:50',
                ]);
            }
        });
    }

    public function getJobsInvolvedIn($id)
    {
        $service = 'ToolInvolvedInJobs';
        $uri = APIHelper::getUrl($service) . $id;
        return APIHelper::getRecord($uri);
    }

    public function show($tool)
    {
        $item = $this->getItem($tool);
        $circulation = $this->getCirculation($item);
        $jobs = $this->getJobsInvolvedIn($item['Id']);
        $jobs = (array)$jobs;

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

    public function update($id, Request $request)
    {
        $itemName = $this->getItem($id)['Item'];        // move it in the data array
        $uri = APIHelper::getUrl('ToolEdit') . $id;
        $imageArray = null;
        $data = [
            'Id' => $id,
            'Item' => $itemName,
            'Asset' => request('Asset'),
            'Arrived' => request('Arrived'),
            'Invoice' => request('Invoice'),
            'CCD' => request('CCD'),
            'NameRus' => request('NameRus'),
            'PositionCCD' => request('PositionCCD'),
            'ItemStatus' => request('ItemStatus'),
            'Box' => request('Box'),
            'Container' => request('Container'),
//            'ItemImage' => base64_encode(file_get_contents(request(('image')))),
            'Comment' => request('Comment')
        ];
        if ($request->hasFile('image'))
        {
            $imageArray = array('ItemImage' => base64_encode(file_get_contents(request(('image')))));
            $data = array_merge($data, $imageArray);
        }

        APIHelper::updateRecord($uri, $data);

        return redirect('/tools');
    }

    public function getItem($id)
    {
        $service = 'ToolGetLRL';
        $uri = APIHelper::getUrl($service) . $id;
        return (array)(APIHelper::getRecord($uri)[0]);
    }

    public function getItemItemAsset($item, $asset)
    {
        $service = 'ToolGetItemAsset';
        $uri = APIHelper::getUrl($service) . "?item=" . $item . "&asset=" . $asset;
        return APIHelper::getRecordItemAsset($uri);
    }
}
