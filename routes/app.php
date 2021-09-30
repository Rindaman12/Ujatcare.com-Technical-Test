<?php

use Illuminate\Support\Facades\Route;

/*
| Here is where you can register web routes for your application. Mostly the ones
| Used in the app instance
*/

Route::get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get(
        '/home',
        function () {
            return view('app.home');
        }
    );

    Route::get(
        '/add',
        function () {
            return view('app.home');
        }
    );
});
