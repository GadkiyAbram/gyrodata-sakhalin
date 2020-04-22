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
}
