<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::post('/url', 'UrlController@saveUrl')->middleware('auth:api');
Route::delete('/url', 'UrlController@deleteUrl')->middleware('auth:api');
Route::get('/url/count', 'UrlController@countUrlDuplicates')->middleware('auth:api');
