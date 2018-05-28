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

// 認証系API
Route::prefix('auth')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/token', 'AuthController@token');
    Route::post('/destroy', 'AuthController@destroy');
});

// タスク系API
Route::prefix('task')->group(function () {
    Route::post('/add', 'TaskController@add');
    Route::post('/list/incomplete', 'TaskController@incomplete');
    Route::post('/list/complete', 'TaskController@complete');
    Route::post('/update', 'TaskController@update');
    Route::post('/delete', 'TaskController@delete');
});

// ランキング系API
Route::prefix('rank')->group(function () {
    Route::get('/list', 'RankController@list');
});