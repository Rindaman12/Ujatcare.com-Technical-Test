<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//We separate the routes by named files to avoid mistakes adn enforce a cleaning coding style

Route::group([], __DIR__ . '/auth.php');

Route::group([], __DIR__ . '/app.php');

Route::group([], __DIR__ . '/images.php');
