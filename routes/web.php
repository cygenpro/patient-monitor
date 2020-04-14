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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/verify-phone', 'PhoneVerificationController@show')->name('phone.verify.show');
Route::post('/verify-phone', 'PhoneVerificationController@verify')->name('phone.verify.submit');
Route::post('/verify-phone/resend', 'PhoneVerificationController@resend')->name('phone.verify.resend');

Route::group(['prefix' => 'doctor'], function () {
    Route::get('/dashboard', 'Doctor\DashboardController@index');
    Route::get('/patient/{patient}', 'Doctor\PatientController@show');
    Route::post('/add-patient', 'Doctor\PatientController@addPatient');
});

Route::group(['prefix' => 'patient'], function () {
    Route::get('/dashboard', 'Patient\DashboardController@index');
    Route::post('/report', 'Patient\ReportController@store');
});

