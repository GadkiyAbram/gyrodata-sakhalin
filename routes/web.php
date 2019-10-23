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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/batteries', 'BatteriesController@index');
Route::get('/batteries/addbattery', 'BatteriesController@addBattery');
Route::post('/batteries', 'BatteriesController@store');

Route::get('/jobs', 'JobsController@index');
Route::get('/jobs/addjob', 'JobsController@addJob');
Route::post('/jobs', 'JobsController@store');
