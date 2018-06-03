<?php

Route::get('start-up', 'API\StartUpController@index');
Route::get('cities/{provinceId}', 'API\StartUpController@getCities');
Route::get('get-city-zipcode/{cityId}', 'API\StartUpController@getCityZipCode');
Route::get('get-question-id/{answerId}', 'API\StartUpController@getQuestionId');
Route::post('enrollment', 'API\StartUpController@enrollment');
Route::get('courses', 'API\Course\CourseController@index');
Route::get('roles', 'API\StartUpController@getRoles');
Route::get('enrollees', 'API\Enrollee\EnrolleeController@getEnrollees');
Route::get('jhs', 'API\ConfirmEnrolled\ConfirmedEnrolledController@jhs');
Route::post('jhs/search', 'API\ConfirmEnrolled\ConfirmedEnrolledController@searchJhs');
Route::get('shs', 'API\ConfirmEnrolled\ConfirmedEnrolledController@shs');
Route::get('shs/print/{confirmId}', 'API\ConfirmEnrolled\ConfirmedEnrolledController@shsPrint');
Route::post('shs/search', 'API\ConfirmEnrolled\ConfirmedEnrolledController@searchShs');
Route::get('confirm-enrolled', 'API\ConfirmEnrolled\ConfirmedEnrolledController@index');
Route::get('confirm-enrolled/{id}', 'API\ConfirmEnrolled\ConfirmedEnrolledController@edit');
Route::post('confirm-enrolled/search', 'API\ConfirmEnrolled\ConfirmedEnrolledController@search');
Route::delete('confirm-enrolled/{id}', 'API\ConfirmEnrolled\ConfirmedEnrolledController@destroy');
Route::get('confirm-enrolled/print/{confirmEnrolleeId}', 'API\ConfirmEnrolled\ConfirmedEnrolledController@print');
Route::put('confirm-enrolled/{id}', 'API\ConfirmEnrolled\ConfirmedEnrolledController@update');
Route::post('auth/register', 'API\User\UserController@register');
Route::post('auth/login', 'API\User\UserController@login');
Route::get('auth/logout', 'API\User\UserController@logout');
Route::post('profile-update', 'API\User\UserController@profileUpdate');
Route::group(['middleware' => ['jwt.auth', 'role:admin']], function () {
    Route::get('user', 'API\User\UserController@getAuthUser');
});
