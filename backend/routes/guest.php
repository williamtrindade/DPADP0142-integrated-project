<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return
    "
        <p>API V1.0</p>
    ";
});

/*
 * -----------------------------------------
 * Account
 * _________________________________________
 */
Route::post('accounts', 'AccountController@create');

/*
 * -----------------------------------------
 * Employees
 * _________________________________________
 */
Route::post('employees/validate/hash', 'EmployeeInvitationController@validateHash');

/*
 * -----------------------------------------
 * Users
 * _________________________________________
 */
Route::post('users/invitation/hash', 'UserController@createByInvitationHash');
