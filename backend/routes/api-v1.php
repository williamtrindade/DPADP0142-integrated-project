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
    Route::put('users/{id}/working/hour/{working_hour_id}', 'UserController@updateWorkingHour');
    Route::put('users/{id}', 'UserController@update');

    // WorkingHourController
    Route::get('working/hours', 'WorkingHourController@index');
    Route::post('working/hours', 'WorkingHourController@create');
    Route::delete('working/hours/{id}', 'WorkingHourController@delete');
    Route::get('working/hours/{id}', 'WorkingHourController@read');
    Route::put('working/hours/{id}', 'WorkingHourController@update');

    // User address update
    Route::put('users/{id}/address', 'UserController@updateAddress');

    // Unapproved Point Records
    Route::get('pointRecords/unapproved', 'PointRecordController@getAllUnapproved');
    Route::put('pointRecords/{id}/approve', 'PointRecordController@approve');
    Route::put('pointRecords/{id}/unapprove', 'PointRecordController@unapprove');

    // Reports
    Route::get('reports', 'ReportsController@reports');

});

/*
 * ----------------------------------------
 * Employee Permission
 * ________________________________________
 */
Route::middleware([EmployeePermission::class])->group(function () {
    // Point Records
    Route::get('pointRecords', 'PointRecordController@index');
    Route::post('pointRecords', 'PointRecordController@create');
});
