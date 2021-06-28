<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\JWT;
use Illuminate\Support\Facades\Cookie;

class AppController extends BaseController
{

    public function index(Request $request)
    {
        // $token = JWT::create();
        //  echo ($token);
        //  echo '<br>';
        //  dd(JWT::create(1,'abc'));
        // dd($access_token = $request->header('Authorization'));
        dd(JWT::create_accessToken(1,1,time()));
        return response()->json(['token' =>JWT::create_accessToken(1,1,time())]);

    }

    public function refreshTokens(Request $request)
    {
        // JWT::refresh($request->cookie('refreshToken'));

    }

    public function login(Request $request)
    {

        // $return = $request->only('login','password','remember','device');
        // $return = $request->data;
        $return = JWT::generate(1,1,$request->remember,$request->device);
        // $return['sdf'] = 'asdf';
        // return response()->json($return);
        return $this->sendResponse($return,"OK");
    }

    public function logout(Request $request)
    {
        //dd($request);
        //$credetials = $request->only('login', 'password');
        // $request;
        // $return = $request->header('Authorization');
        // return response()->json([]);
        $return['user'] = $request->user_id;
        $return['role'] = $request->user_role;
        $return['applied_role'] = $request->applied_role;
        return $this->sendResponse($return,"OK");

        // return $this->sendResponse($request->header('Authorization'),"OK");
    }

}
