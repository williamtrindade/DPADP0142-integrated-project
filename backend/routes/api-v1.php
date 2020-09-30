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

Route::post('users', 'UserController@create');

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
    // UserController
    Route::get('users', 'UserController@index');
    Route::delete('users/{id}', 'UserController@delete');
    Route::get('users/{id}', 'UserController@read');

    // WorkingHourController
    Route::post('working/hours', 'WorkingHourController@create');
});

/*
 * ----------------------------------------
 * Employee Permission
 * ________________________________________
 */
Route::middleware([EmployeePermission::class])->group(function () {

});
