<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubAdminController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:sub_admins,email' ,
            'password' => 'required|string' ,
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()->all() ], 401);
        }
        $credentials = request(['email', 'password']);
        if (! $token = auth()->guard('sub_admins')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(auth()->guard('sub_admins')->user());
    }


    public function logout()
    {
        auth()->guard('sub_admins')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('sub_admins')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('sub_admins')->factory()->getTTL() * 60
        ]);
    }

    public function sayHello(){
        return response()->json('hello sub-admin');
    }

}
