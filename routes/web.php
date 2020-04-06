<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify-phone', 'PhoneVerificationController@show')->name('phone.verify.show');
Route::post('/verify-phone', 'PhoneVerificationController@verify')->name('phone.verify.submit');
Route::post('/verify-phone/resend', 'PhoneVerificationController@resend')->name('phone.verify.resend');

Route::group(['prefix' => 'doctor'], function () {
    Route::get('/dashboard', 'DoctorDashboardController@index');
    Route::get('/patient/{patient}', 'DoctorDashboardController@getPatient');
    Route::post('/patient', 'DoctorDashboardController@addPatient');
});

Route::group(['prefix' => 'patient'], function () {
    Route::get('/dashboard', 'PatientDashboardController@index');
    Route::post('/report', 'PatientDashboardController@report');
});

