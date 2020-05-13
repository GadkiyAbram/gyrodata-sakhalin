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

    public static function getToolData($what, $where)
    {
        $uri = APIHelper::getUrl('ToolsAll'). "?what=" . $what . "&where=" . $where;
        $token = session()->get('Token');
        $client = new \GuzzleHttp\Client(['base_uri' => $uri]);
        try{
            $response = $client->get($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $token
                ]
            ]);
            $items = json_decode((string)$response->getBody());
            $items = (array)$items;

        }catch (\Exception $ex){
            dd($ex);
        }
        return $items;
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
    }
}
