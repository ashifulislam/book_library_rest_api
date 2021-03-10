<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Admin;
class AuthorAuthController extends Controller
{


    public function login()
    {
        if(Auth::guard('author')->attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::guard('author')->user();
            $success['token'] =  $user->createToken('author')->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else
            {
            return response()->json(['error'=>'Unauthorised'], 202);
        }
    }
    public function getDetails()
    {
        $user = Auth::guard('author-api')->user();
        return response()->json(['success' => $user], 200);
    }

}
