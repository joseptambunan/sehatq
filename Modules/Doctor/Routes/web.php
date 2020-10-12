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

Route::prefix('doctor')->group(function() {
    Route::get('/', 'DoctorController@doctors');
    Route::get('/hospitals', 'DoctorController@hospitals');
    Route::get('/doctor_hospital', 'DoctorController@doctor_hospital');
    Route::post('/booking', 'DoctorController@booking');
    Route::get('/schedule','DoctorController@schedule');
});
