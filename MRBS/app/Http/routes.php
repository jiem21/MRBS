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

Route::get('/', function () {
    return view('front-page');
});

Route::post('/validate','LoginController@authenticate')->name('validate');


Route::auth();


Route::group(['middleware' => ['auth']],function(){
Route::get('/dashboard','HomeController@index')->name('home');

// Booking
Route::get('/Booking','BookingController@index')->name('booking');
Route::post('/Meeting-Room-Booking','BookingController@save_booking')->name('mrbooking');
Route::get('/Check-Start-Time','BookingController@check_start_time')->name('checksttime');
Route::get('/Get-End-Time','BookingController@get_end_time')->name('getendtime');


// Manage Booking
Route::get('/View-Booking/{id}','BookingController@viewbook')->name('viewbook');
Route::get('/Admin/Manage-Booking','BookingController@manage_booking')->name('mngbooking');
Route::any('/Admin/Manage-Booking/Approved','BookingController@approved')->name('appbooking');
Route::post('/Admin/Manage-Booking/Disapproved','BookingController@disapproved')->name('disappbooking');
Route::post('/Admin/Manage-Booking/Cancellation-Request','BookingController@cancellation')->name('cancelbooking');


// Rooms
Route::get('/Admin/Room-Maintenance','RoomController@index')->name('rooms');
Route::post('/Admin/Room-Maintenance/Save','RoomController@save')->name('rooms-save');


// User Maintenance
Route::get('/Admin/User-Maintenance','UserController@index')->name('usermain');
Route::post('/Admin/User-Maintenance/Add-New-User','UserController@addaccount')->name('addaccount');


});