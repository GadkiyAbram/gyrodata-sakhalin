<?php


namespace App\Http\Controllers;


class APIHelper extends Controller
{
    public static function getUrl($service)
    {
        $scheme = config('url.scheme');
        $url = config('url.url');
        $port = config('url.port');

        $pathService = config('url.'.$service);

        $path = $scheme.
                $url.
                ":".
                $port.
                $pathService;

        return $path;
    }

//    public static function getRecord($service, $what, $where)
    public static function getRecord($uri)
    {
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $data = json_decode((string)$response->getBody());
            $data = (array)$data;

        }catch (\Exception $ex){
            dd($ex);
        }
        return $data;
    }

    public static function updateRecord($uri, $data)
    {
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
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
    }

    public static function getComponentsForTools($service)
    {
        $uri = APIHelper::getUrl($service);
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
        return $components;
    }

    public static function insertRecord($uri, $data)
    {
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->post($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ],
                'body' => json_encode($data)
            ]);
            $record_id = json_decode((string)$response->getBody());
        }catch (\Exception $ex){
            dd($ex);
        }
        return $record_id;
    }
}
