<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Tymon\JWTAuth\Contracts\Providers\Auth;

class ClientController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:clients,email' ,
            'password' => 'required|string' ,
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()->all() ], 401);
        }
        $credentials = request(['email', 'password']);
        if (! $token = auth()->guard('clients')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(auth()->guard('clients')->user());
    }


    public function logout()
    {
        auth()->guard('clients')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('clients')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('clients')->factory()->getTTL() * 60
        ]);
    }

    public function sayHello(){
        return response()->json('hello client');
    }
    function get_guard(){
        if(Auth::guard('admins')->check())
        {return "admin";}
        elseif(Auth::guard('sub_admins')->check())
        {return "user";}
        elseif(Auth::guard('clients')->check())
        {return "client";}
    }
}
