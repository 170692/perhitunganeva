<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () { return view('report'); });
Route::get('/eva', function () { return view('eva'); });

Route::post('earnedvalueanalysis', 'EvaController@debug');
Route::get('earnedvalueanalysis', 'EvaController@index');
Route::get('earnedvalueanalysis/last', 'EvaController@get');
Route::get('earnedvalueanalysis/bydate', 'EvaController@push');
Route::get('projectname', 'EvaController@getProjectName');
Route::post('uploadXML', 'EvaController@uploadXML');
// Route::get('earnedvalueanalysis', 'EvaController@graphic');
