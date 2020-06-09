<?php

namespace App\Http\Controllers;

use App\UsersPending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersPendingController extends Controller
{
    public function store(Request $request)
    {
//        dd($request->email);
        UsersPending::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        // TODO - check if it's in DB already, change the message
        return redirect()->back() ->with('alert', 'Thank you, ' . $request->first_name . ' admin will contact you shortly');
    }
}
