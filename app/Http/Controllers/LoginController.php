<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if(\Auth::attempt($credentials))
            return response()->json(User::where('email' , $request['email'])->first());
        else
            return response(['message' => 'unauthorized'] , 401);
    }


    function register(Request $request){

        return User::first();
    }

}
