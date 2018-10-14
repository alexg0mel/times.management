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


});


Route::group([
    'prefix' => 'cabinet',
    'as' => 'cabinet.',
    'namespace' => 'Cabinet',
    'middleware' => ['auth',],
], function () {
    Route::get('/', 'HomeController@index')->name('cabinet');
    Route::get('/activetask', 'ActivetaskController@index')->name('task.active');
    Route::get('/activetask2', 'ActivetaskController@index2')->name('task.active2');


});
