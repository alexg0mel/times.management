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


        });
    });