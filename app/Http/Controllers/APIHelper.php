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
            $battery_id = json_decode((string)$response->getBody());
        }catch (\Exception $ex){
            dd($ex);
        }
    }
}
