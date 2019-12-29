<?php

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

Route::get('gsearch', 'Controller@gsearch');
Route::get('/', 'Controller@gsearch');
Route::get('result', 'Controller@result');
Route::post('gsearch', 'Controller@tosearch');