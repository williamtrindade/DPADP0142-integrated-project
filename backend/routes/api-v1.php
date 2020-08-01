<?php

use Illuminate\Support\Facades\Route;

/*
 * -----------------------------------------
 * Users
 * _________________________________________
 */
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');
Route::get('me', 'UserController@getMe');
Route::put('me', 'UserController@updateMe');
/*
 * -----------------------------------------
 * Account
 * _________________________________________
 */
// Route::post('accounts', 'AccountController@create');
