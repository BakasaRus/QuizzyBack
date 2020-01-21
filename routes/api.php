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

Route::middleware('auth:airlock')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:airlock')->resource('/tests', 'TestController')->except(['create', 'edit']);
Route::middleware('auth:airlock')->post('/tests/{test}/attempt', 'AttemptController@store');
