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
        $uri = APIHelper::getUrl('BatteriesAll'). "?what=&where=";
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

//        $batteries = \App\Battery::all();
//        dd($batteries);


        return view('batteries/index', compact('batteries', 'count'));
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


//        $token = session()->get('Token');
//        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
//
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
//
//        try{
//            $response = $client->post($uri, [
//                'headers' => [
//                    'Content-Type' => 'application/json',
//                    'Token' => $token
//                ],
//                'body' => json_encode($data)
////                'body' => json_encode(
////                    [
////                        'BoxNumber' => request('BoxNumber'),
////                        'BatteryCondition' => request('BatteryCondition'),
////                        'SerialOne' => request('serialOne'),
////                        'SerialTwo' => request('serialTwo'),
////                        'SerialThr' => request('serialThree'),
////                        'CCD' => request('batteryCcd'),
////                        'Invoice' => request('batteryInvoice'),
////                        'Arrived' => request('date'),
////                        'BatteryStatus' => request('batteryStatus'),
////                        'Container' => request('Container'),
////                        'Comment' => request('Comment')
////                    ]
////                )
//            ]);
//            $battery_id = json_decode((string)$response->getBody());
//        }catch (\Exception $ex){
//            dd($ex);
//        }
////        $data = request()->validate([
////            'serialOne' => 'required',
////            'condition' => 'required',
////        ]);
////        $battery = new \App\Battery();
////        $battery->serialOne = request('serialOne');
////        $battery->serialTwo = request('serialTwo') ?? 'N/A';
////        $battery->serialThr = request('serialThr') ?? 'N/A';
////        $battery->Arrived = request('date');
////        $battery->Invoice = request('battery_invoice');
////        $battery->CCD = request('battery_ccd');
////        $battery->BatteryCondition = request('condition');
////        $battery->Container = request('container');
////        $battery->Comment = request('comment');
////        $battery->save();

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
