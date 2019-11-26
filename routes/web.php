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

//    $eng = factory(\App\Engineer::class)->create();

//    $tool = factory(\App\Tool::class)->create();
//    $tool->save();
//
//    $job = factory(\App\Job::class)->create();
//    $battery = factory(\App\Battery::class)->create();
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
//
//    foreach (file(public_path('/personnel.txt')) as $line)
//    {
//        $line = str_replace("\r\n", '', $line);
//        $eng = new \App\Engineer();
//        $eng->name = $line;
//        $eng->save();
//    }

//    $battery = new \App\Battery();
//    $battery->serialOne = 'S1-0652-N-0001';
//    $battery->condition = 1;
//    $battery->save();

    return view('welcome');
});

Auth::routes();

//Route::get('/batteries', 'BatteriesController@index');
//Route::get('/batteries/create', 'BatteriesController@create');
//Route::post('/batteries', 'BatteriesController@store');

Route::resource('batteries', 'BatteriesController');

//Route::get('/jobs', 'JobsController@index');
//Route::get('/jobs/create', 'JobsController@create');
//Route::post('/jobs', 'JobsController@store');
//Route::get('/jobs/{job}', 'JobsController@show');
//Route::get('/jobs/{job}/edit', 'JobsController@edit');
//Route::patch('/jobs/{job}', 'JobsController@update');

Route::resource('jobs', 'JobsController');

//Route::get('/tools', 'ToolsController@index');
//Route::get('/tools/create', 'ToolsController@create');
//Route::post('/tools', 'ToolsController@store');
//Route::get('/tools/{tool}', 'ToolsController@show');

Route::resource('tools', 'ToolsController');

Route::get('/ccd', 'CCDController@index');
