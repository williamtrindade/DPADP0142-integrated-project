<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');
