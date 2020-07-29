<?php

use Illuminate\Support\Facades\Route;

/*
 * -----------------------------------------
 * Users
 * _________________________________________
 */
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');

/*
 * -----------------------------------------
 * Account
 * _________________________________________
 */
// Route::post('accounts', 'AccountController@create');
