<?php

use Illuminate\Support\Facades\Route;

/*
 * ----------------------------------------
 * User Me
 * ________________________________________
 */
Route::get('me', 'UserController@getMe');
Route::put('me', 'UserController@updateMe');

/*
 * -----------------------------------------
 * Users
 * _________________________________________
 */
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');

/*
 * -----------------------------------------
 * Accounts
 * _________________________________________
 */
Route::get('accounts/{id}', 'AccountController@read');
Route::put('accounts/{id}', 'AccountController@update');

/*
 * ----------------------------------------
 * Employee
 * ________________________________________
 */
Route::post('employees/invite', 'EmployeesController@inviteEmployee');
