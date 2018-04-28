<?php

Route::get('start-up', 'API\StartUpController@index');
Route::get('cities/{provinceId}', 'API\StartUpController@getCities');
Route::get('get-city-zipcode/{cityId}', 'API\StartUpController@getCityZipCode');
Route::get('courses', 'API\Course\CourseController@index');