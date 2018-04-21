<?php

Route::get('/api/admission/all', 'AdmissionController@apiAll');
Route::get('/', 'NavController@home');
Route::get('about', 'NavController@about');
Route::get('enroll', 'NavController@enroll');
Route::resource('admission', 'AdmissionController');
