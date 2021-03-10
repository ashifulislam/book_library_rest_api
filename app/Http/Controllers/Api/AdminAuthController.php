<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Admin;
class AdminAuthController extends Controller
{


    public function login()
    {
        if(Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::guard('admin')->user();
            $success =  $user->createToken('admin')->accessToken;
            return response()->json(['success' => $success, 'status' => 200]);
        }
        else
            {
            return response()->json(['error'=>'Unauthorised'], 202);
        }
    }


}
