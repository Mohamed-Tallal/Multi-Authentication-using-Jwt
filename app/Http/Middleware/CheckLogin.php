<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckLogin extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('api')->check()) {
            try {
                JWTAuth::parseToken()->authenticate();
            } catch (Exception $exception) {
                if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json('Invalid Exception');
                } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return response()->json('Expired Exception');
                } else {
                    return response()->json('please login and return go to request ');
                }
            }
            return $next($request);
        }
        return response()->json('please login and return go to request ');
    }

}
