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
