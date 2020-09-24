<?php

use App\Http\Middleware\EmployeePermission;
use App\Http\Middleware\ManagerPermission;
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
 * Accounts
 * _________________________________________
 */
Route::get('accounts/{id}', 'AccountController@read');
Route::put('accounts/{id}', 'AccountController@update');

/*
 * -----------------------------------------
 * Users
 * _________________________________________
 */
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');
Route::delete('users/{id}', 'UserController@delete');

/*
 * ----------------------------------------
 * Employee
 * ________________________________________
 */
Route::post('employees/invite', 'EmployeeInvitationController@inviteEmployee');

/*
 * ----------------------------------------
 * Manager Permission
 * ________________________________________
 */
Route::middleware([ManagerPermission::class])->group(function () {

});

/*
 * ----------------------------------------
 * Employee Permission
 * ________________________________________
 */
Route::middleware([EmployeePermission::class])->group(function () {

});
