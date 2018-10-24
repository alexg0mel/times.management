<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.', 'namespace' => 'Api'],
    function () {
        Route::get('/', 'HomeController@home');

        Route::middleware('auth:api')->group(function () {

            Route::get('/user', function (Request $request) {
                return $request->user();
            });

            Route::get('/projects', 'ProjectController@index');
            Route::get('/projects/{project}/tasks', 'ProjectController@tasks');
            Route::post('/projects/{project}/tasks/{task}/link', 'ProjectController@link');
            Route::delete('/projects/{project}/tasks/{task}/link', 'ProjectController@unlink');
            Route::group(['prefix'=>'groups','as'=>'groups'],function (){
                Route::get('/{group}/projects', 'GroupController@projects');
                Route::get('/free-tasks/{project}', 'GroupController@freeTasks');
                Route::get('/group-tasks/{project}/{group}', 'GroupController@groupTasks');
                Route::post('/link-tasks/{group}/{task}', 'GroupController@linkTasks');
                Route::delete('/link-tasks/{group}/{task}', 'GroupController@unlinkTasks');

            });
            Route::get('/tasks', 'StepController@tasks');
            Route::post('/start-time/{group}/{task}', 'StepController@startTime');
            Route::get('/get-time','StepController@getTime');
            Route::put('/time','StepController@putOpis');
            Route::put('/stop-time','StepController@stopTime');


        });
    });