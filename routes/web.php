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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth',],
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('projects', 'ProjectController');
    Route::put('projects/{project}/active', 'ProjectController@active')->name('project.active');
    Route::group(['prefix' => 'projects/{project}', 'as' => 'projects.'], function () {
        Route::resource('tasks', 'TaskController')->except('index');
    });
    Route::resource('timelines','TimelinesController');
    Route::put('timelines/{timeline}/status/{status}', 'TimelinesController@status')->name('timelines.status');
    Route::group(['prefix' => 'timelines/{timeline}', 'as' => 'timelines.'], function () {
        Route::resource('groups', 'GroupController')->except('index');
    });


});


Route::group([
    'prefix' => 'cabinet',
    'as' => 'cabinet.',
    'namespace' => 'Cabinet',
    'middleware' => ['auth',],
], function () {
    Route::get('/', 'HomeController@index')->name('cabinet');
    Route::get('/report-day', 'ReportController@report')->name('report');
    Route::get('/activetask', 'ActivetaskController@index')->name('task.active');


});
