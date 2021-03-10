<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Admin;
class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)) {
            return response(['message'=>'Invalid credentials'],201);
        }

        //Here user create the access token
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json(['success' => $accessToken, 'status' => 200]);

    }


    public function user_register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

            $validatedData['password'] = bcrypt($request->password);


            $user = User::create($validatedData);

            $accessToken = $user->createToken('authToken')->accessToken;
            if ($accessToken) {
                return response()->json(['success' => 'completed', 'status' => 200]);

            } else {
                return response()->json(['error' => 'jhju'], 202);

            }
        }

}
