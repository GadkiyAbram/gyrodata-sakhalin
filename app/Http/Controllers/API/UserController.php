<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\UserGranted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class UserController extends Controller
{
    public function __construct()
    {
        //Previous
//        $this->middleware('api');
        //Now
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8'
        ]);

        return User::create(
            [
                'name' => $request['name'],
                'lastname' => $request['lastname'],
                'email' => $request['email'],
                'type' => $request['type'],
                'bio' => $request['bio'],
                'photo' => $request['photo'],
                'password' => Hash::make($request['password']),
//                'password' => hash('sah256', $request['password'] . 'salt'),
                'Salt' => 'salt'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
        return auth('api')->user();
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos
                ($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path
                ('img/profile/').$name);

            $request->merge(['photo' => $name]);
        }


        $user->update($request->all());
        return ['message' => 'Success'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $user = User::findOrFail($id);
//
//        $this->validate($request, [
//            'name' => 'required|string|max:191',
//            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
//            'password' => 'sometimes|min:8'
//        ]);
//
//        $user->update($request->all());
//
//        return ['message' => 'Updating the user info'];

        //updating user in users table
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:8'
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($userData['password']);

        $user->update($userData);

        //updating user in User table
        // $userU = UserGranted::findOrFail($id);
        // $userU['Password'] = hash('sha256', $userData['password'] . 'salt');
        // $userU->update();

        return ['message' => 'Updating the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // delete the user
        $user->delete();

        return ['message' => 'User Deleted'];
    }
}
