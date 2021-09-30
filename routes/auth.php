<?php

use Illuminate\Support\Facades\Route;

/*
| Here is where you can register web routes for your application. Mostly the ones
| Used in the auth instance
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Auth::routes();
