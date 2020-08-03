<?php

namespace App\Http\Controllers;

use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TokenController extends Controller
{
    public function index()
    {
        return view('token.index');
    }

    public function store(Request $request)
    {
//        dd($request->session());
        $uri = APIHelper::getUrl('Auth');
        $client = new \GuzzleHttp\Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        try{
           $response = $client->post($uri,
               [
                   'body' => json_encode(
                       [
                           'User' => request('User'),
                           'Password' => request('Password')
                       ]
                   )
               ]);

            $result = json_decode((string)$response->getBody());

            $request->session()->put('Token', $result);
            $request->session()->save();

        }catch (\Exception $ex){
            dd($ex);
        }
//        dd($result);
        return redirect('/');
    }
}
