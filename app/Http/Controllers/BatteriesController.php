<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidSerialOne;

class BatteriesController extends Controller
{
    // get all serials from existing batteries in db
    private $batt_serials = [];

    public function index()
    {
        return view('batteries.index');
    }

    public function searchBatteries(Request $request)
    {
        $what = $request->search_data;
        $where = $request->search_where;

        $batteries = $this->getBatteryData($what, $where);

        return view('batteries.data', compact('batteries'));
    }

    public function getBatteryData($what, $where)
    {
        $service = 'BatteriesAll';
        $uri = APIHelper::getUrl($service). "?what=" . $what . "&where=" . $where;
        return APIHelper::getRecord($uri);
    }

    public function edit($id)
    {
        $battery = $this->getBattery($id);

        return view('batteries.edit', compact('battery'));
    }

    public function show($id)
    {
        $battery = $this->getBattery($id);

        return view('batteries.show', compact('battery'));
    }

    public function getBattery($id)
    {
        //TODO - add job to battery assigned
        $service = 'BatteryCustom';
        $uri = APIHelper::getUrl($service) . $id;
        return (array)(APIHelper::getRecord($uri))[0];
    }

    public function create()
    {
        return view('batteries/create');
    }
    public function store()
    {

        $this->validateBatteryStore();

        $service = 'BatteryAdd';
        $uri = APIHelper::getUrl($service);
        $data = [
            'BoxNumber' => request('BoxNumber'),
            'BatteryCondition' => request('BatteryCondition'),
            'SerialOne' => request('serialOne'),
            'SerialTwo' => request('serialTwo'),
            'SerialThr' => request('serialThree'),
            'CCD' => request('batteryCcd'),
            'Invoice' => request('batteryInvoice'),
            'Arrived' => request('date'),
            'BatteryStatus' => request('batteryStatus'),
            'Container' => request('Container'),
            'Comment' => request('Comment')
        ];

        $battery_id = APIHelper::insertRecord($uri, $data);

        return redirect('/batteries');
    }

    public function validateBatteryStore(){
        return tap(request()->validate([
            'SerialOne' => ['required', new ValidSerialOne(request('serialOne'))]
        ]));
    }

    public function update($id)
    {
        $service = 'BatteryEdit';
        $uri = APIHelper::getUrl($service) . $id;
        $data = [
            'Id' => $id,
            'BoxNumber' => request('BoxNumber'),
            'BatteryCondition' => request('BatteryCondition'),
            'SerialOne' => request('serialOne'),
            'SerialTwo' => request('serialTwo'),
            'SerialThr' => request('serialThree'),
            'CCD' => request('batteryCcd'),
            'Invoice' => request('batteryInvoice'),
            'Arrived' => request('date'),
            'BatteryStatus' => request('BatteryStatus'),
            'Container' => request('Container'),
            'Comment' => request('Comment')
        ];
        APIHelper::updateRecord($uri, $data);

        return redirect('/batteries');
    }
}
