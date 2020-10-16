<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login-user', 'AuthController@login');

Route::middleware('CheckAuth:api')->group(function () {
    Route::post('/me-user', 'AuthController@me');
    Route::post('/logout-user', 'AuthController@logout');
    Route::post('/hello-user', 'AuthController@sayHello');
});

Route::post('login-admin', 'AdminController@login');
Route::middleware('CheckAdmin:admins')->group(function () {
    Route::post('/me-admin', 'AdminController@me');
    Route::post('/logout-admin', 'AdminController@logout');
    Route::post('/hello-admin', 'AdminController@sayHello');
});

Route::post('login-client', 'ClientController@login');
Route::middleware('ClientLogin:clients')->group(function () {
    Route::post('/me-client', 'ClientController@me');
    Route::post('/logout-client', 'ClientController@logout');
    Route::post('/hello-client', 'ClientController@sayHello');

});

Route::post('login-sub-admin', 'SubAdminController@login');
Route::middleware('SubLogin:sub_admins')->group(function () {
    Route::post('/me-sub-admin', 'SubAdminController@me');
    Route::post('/logout-sub-admin', 'SubAdminController@logout');
    Route::post('/hello-sub-admin', 'SubAdminController@sayHello');

});

