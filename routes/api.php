<?php

use Illuminate\Http\Request;

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

Route::prefix('token')->group(function () {
    Route::post('/auth', 'AuthController@token');
    Route::post('/destroy', 'AuthController@destroy');
});

Route::prefix('task')->group(function () {
    Route::post('/add', 'TaskController@add');
    Route::post('/list', 'TaskController@list');
    Route::post('/update', 'TaskController@update');
    Route::post('/delete', 'TaskController@delete');
});