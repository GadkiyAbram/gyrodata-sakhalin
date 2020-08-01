<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use App\UsersGranted;
use App\UsersPending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersPendingController extends Controller
{
    public function __construct()
    {
//        $this->authUser = auth()->id();
        //Previous
//        $this->middleware('api');
        //Now
//        $this->middleware('auth:api');
    }

    public function index()
    {
        $usersPending = UsersPending::all();
        return $usersPending;
    }

    public function approve(Request $request, $id)
    {
        $password_sha = hash('sha256', $request['password'] . 'salt');
        // User profile in users table
        User::create([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
            'approved_id' => $request['approved_id'],
            'Salt' => 'salt'
        ]);

        // User profile for getting Token, User table
        UsersGranted::create([
            'User' => $request['email'],
            'Password' => $password_sha,
            'Salt' => 'salt'
        ]);

        $userP = UsersPending::find($id);

        // delete the user
        $userP->delete();

//        $message = 'User has been approved';
//        return redirect()->back() ->with('alert', $message);
    }

    public function store(Request $request)
    {
        $first_name = $request->name;
        $last_name = $request->lastname;
        $email = $request->email;

        $message = null;

        if ($user = UsersPending::where('email', $email) -> first())
        {
            $created_at = $user->created_at;
            $message = 'Sorry, ' . $first_name . ' we already received your request on ' . $created_at;
        }
        else if ($user = User::where('email', $email) -> first())
        {
            $message = 'Sorry, ' . $first_name . ' you are already with us, just Log In';
        }
        else
        {
            UsersPending::create([
                'name' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
            ]);

            $message = 'Thank you, ' . $first_name . ' admin will contact you shortly';
        }

        return redirect()->back() ->with('alert', $message);
    }
}
