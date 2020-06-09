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
use Illuminate\Support\Facades\Route;

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


// TODO - add middleware auth
// BATTERIES ROUTES
//Route::resource('batteries', 'BatteriesController')->middleware('auth');
Route::get('/batteries', 'BatteriesController@index')->name('batteries.index');
Route::post('/batteries', 'BatteriesController@searchBatteries')->name('batteries.index');
Route::get('/batteries/create', 'BatteriesController@create');
Route::post('/batteries/create', 'BatteriesController@store')->name('batteries.store');
Route::get('/batteries/{id}', 'BatteriesController@show');
Route::get('/batteries/{id}/edit', 'BatteriesController@edit');
Route::patch('/batteries/{id}', 'BatteriesController@update');

// TOOLS ROUTES
//Route::resource('tools', 'ToolsController')->middleware('auth');
Route::get('/tools', 'ToolsController@index')->name('tools.index');
Route::post('/tools', 'ToolsController@searchItems')->name('tools.index');
Route::get('/tools/create', 'ToolsController@create');
Route::post('/tools/create', 'ToolsController@store')->name('tools.store');
Route::get('/tools/{id}', 'ToolsController@show');
Route::get('/tools/{tool}/edit', 'ToolsController@edit');
Route::patch('/tools/{id}', 'ToolsController@update');

// JOBS ROUTES
//Route::resource('jobs', 'JobsController')->middleware('auth');
Route::get('/jobs', 'JobsController@index')->name('jobs.index');
Route::post('/jobs', 'JobsController@searchJobs')->name('jobs.index');
Route::get('/jobs/create', 'JobsController@create');
Route::post('/jobs/create', 'JobsController@store')->name('jobs.store');
Route::get('/jobs/{job}', 'JobsController@show');
Route::get('/jobs/{job}/edit', 'JobsController@edit');
Route::patch('/jobs/{job}', 'JobsController@update');

//LOGIN REGISTER ROUTES
Route::post('/login/request', 'UsersPendingController@store')->name('login.request');

Route::get('/ccd', 'CCDController@index');

//Route::get('/session', 'CCDController@usession');
Route::resource('preferences', 'TokenController')->middleware('auth');
//Route::get('/token', 'TokenController@index');
//Route::post('/token/token', 'TokenController@store');
//Route::post('/token/saveurlport', 'TokenController@storeurlport');

//Route::resource('search', 'SearchController')->middleware('auth');
Route::get('master', 'SearchController@index')->middleware('auth');

Route::get('/home', 'SearchController@index')->name('home');
Route::get('{path}', "SearchController@index");
//->where('path', '([A-z\d-\/_.]+)?' );
//    ->middleware('auth');



