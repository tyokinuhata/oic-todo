<?php

// 認証系API
Route::prefix('auth')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/token', 'AuthController@token');
    Route::post('/destroy', 'AuthController@destroy');
});

// タスク系API
Route::prefix('task')->group(function () {
    Route::post('/add', 'TaskController@add');
    Route::post('/list/complete', 'TaskController@complete');
    Route::post('/list/incomplete', 'TaskController@incomplete');
    Route::post('/update', 'TaskController@update');
    Route::post('/delete', 'TaskController@delete');
    Route::post('/close', 'TaskController@close');
    Route::post('/reopen', 'TaskController@reopen');
});

// ランキング系API
Route::prefix('rank')->group(function () {
    Route::get('/list', 'RankController@list');
});

// ユーザ系API
Route::prefix('user')->group(function () {
    Route::post('/me', 'UserController@me');
});