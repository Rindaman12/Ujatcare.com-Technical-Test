<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/*
| Here is where you can register web routes for your application. Mostly the ones
| Used in the images api
*/



Route::group(['prefix' => '/api','middleware' => 'auth'], function () {
    Route::resource('images', ImageController::class);
});
