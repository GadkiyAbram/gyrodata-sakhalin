<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatteriesController extends Controller
{
    // get all serials from existing batteries in db
    private $batt_serials = [];

    public function index()
    {
        //TODO - remove if checked
//        $uri = 'http://192.168.0.102:8081/batteryservices/batteryservice.svc/GetSelectedBatteries?what=&where=';
//        $uri = APIHelper::getUrl('BatteriesAll'). "?what=&where=";
//        $token = session()->get('Token');
//        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
//        try{
//            $response = $client->get($uri, [
//                'headers' => [
//                    'Content-Type' => 'application/json',
//                    'Token' => $token
//                ]
//            ]);
//            $batteries = json_decode((string)$response->getBody());
//            $batteries = (array)$batteries;
//            foreach ($batteries as $serial)
//            {
//                array_push($this->batt_serials, $serial->SerialOne);
//            }
////            dd($this->batt_serials);
//            $count = count($batteries);
//        }catch (\Exception $ex){
//            dd($ex);
//        }

//        return view('batteries/index', compact('batteries', 'count'));
        return view('batteries.index');
    }

    public function searchBatteries(Request $request)
    {
//        return view('batteries.data');
        $what = $request->search_data;
        $where = $request->search_where;
//        $uri = "http://192.168.0.102:8081/batteryservices/batteryservice.svc/GetSelectedBatteries?what=" . $what . "&where=" . $where;
        $uri = APIHelper::getUrl('BatteriesAll'). "?what=" . $what . "&where=" . $where;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $batteries = json_decode((string)$response->getBody());
            $batteries = (array)$batteries;
            foreach ($batteries as $serial)
            {
                array_push($this->batt_serials, $serial->SerialOne);
            }
//            dd($this->batt_serials);
            $count = count($batteries);
        }catch (\Exception $ex){
            dd($ex);
        }

        return view('batteries.data', compact('batteries'));
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
        $uri = 'http://192.168.0.102:8081/batteryservices/batteryservice.svc/GetSelectedBatteryData/' . $id;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $battery = json_decode((string)$response->getBody());
            $battery = (array)$battery[0];
//            dd($battery);

        }catch (\Exception $ex){
            dd($ex);
        }
        return $battery;
    }

    public function create()
    {

        return view('batteries/create');
    }
    public function store()
    {
        $url = \Config::get('url.url');
        $port = \Config::get('url.port');
        $uri = "http://". $url. ":". $port. "/batteryservices/batteryservice.svc/AddBattery";

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

    public function update($id)
    {
        $uri = 'http://192.168.0.102:8081/batteryservices/batteryservice.svc/EditBattery/' . $id;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
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
        return redirect('/batteries');
    }
}
