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

//    $tool = factory(\App\Tool::class)->create();
//    $tool->save();
//
//    $job = factory(\App\Job::class)->create();
//    $battery = factory(\App\Battery::class)->create();
//    $eng = factory(\App\Engineer::class)->create();
//    factory(\App\Engineer::class, 8)->create();
//    $battery->save();
//
//    $job->battery_id = $battery->id;
//    $job->eng_first_id = $eng->id;
//    $job->save();

//    foreach (file(public_path('/GWDequipment.txt')) as $line)
//    {
//        $line = str_replace("\r\n", '', $line);
//        $item = new \App\Item();
//        $item->name = $line;
//        $item->save();
//    }

    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/batteries', 'BatteriesController@index');
Route::get('/batteries/addbattery', 'BatteriesController@addBattery');
Route::post('/batteries', 'BatteriesController@store');

Route::get('/jobs', 'JobsController@index');
Route::get('/jobs/addjob', 'JobsController@addJob');
Route::post('/jobs', 'JobsController@store');
Route::get('/jobs/{job}', 'JobsController@show');

Route::get('/tools', 'ToolsController@index');
Route::get('/tools/addtool', 'ToolsController@addTool');
Route::post('/tools', 'ToolsController@store');
Route::get('/tools/{tool}', 'ToolsController@show');
