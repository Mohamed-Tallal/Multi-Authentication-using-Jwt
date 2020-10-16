<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*  public function __construct()
    {
        $this->middleware('CheckAuth:api', ['except' => ['login']]);
    }
    */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:users,email' ,
            'password' => 'required|string' ,
        ]);
        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()->all() ], 401);
        }
        $credentials = request(['email', 'password']);
        if (! $token_user = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token_user);
    }

    public function sayHello(){
        return response()->json('hello user');
    }
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }


    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }
}
