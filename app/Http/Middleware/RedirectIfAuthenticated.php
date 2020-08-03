<?php

namespace App\Http\Middleware;

use App\Http\Controllers\APIHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->getToken($request);
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }

    public function getToken(Request $request)
    {
        $password = request('password');
        $password_sha = hash('sha256', $password . 'salt');
//        dd($password_sha);
        $uri = APIHelper::getUrl('Auth');
        // $uri = "http://192.168.1.105:8081/authservices/authservice.svc/authenticate";
        // dd($uri);
        $client = new \GuzzleHttp\Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
        try{
            $response = $client->post($uri,
                [
                    'body' => json_encode(
                        [
                            'User' => request('email'),
                            'Password' => request('password')
//                            'Password' => $password_sha
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
//        return redirect('/');
    }
}
