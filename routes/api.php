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
$api = app('Dingo\Api\Routing\Router');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api->version('v1', function($api){
	$api->get('enrolldata','App\Http\Controllers\NavController@enrollData');
	$api->get('admissions','App\Http\Controllers\AdmissionController@index');
	$api->get('schoolyear','App\Http\Controllers\SyController@index');
	$api->get('courses','App\Http\Controllers\CourseController@index');
	$api->get('semesters','App\Http\Controllers\SemesterController@index');
});