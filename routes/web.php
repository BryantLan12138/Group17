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

Route::get('/', 'MapController@map' );
Route::post('/', 'MapController@sendFeedback')->name('sendFeedback');
Auth::routes();

Route::group(['middleware' => ['auth' => 'isadmin']], function()
{
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/cars_management','AdminController@cars_management');
    Route::get('/admin/orders_management','AdminController@orders_management');
    Route::get('/admin/users_management','AdminController@users_management');
    Route::get('/admin/cars_management/{cars}', 'AdminController@car_edit');
    Route::get('/admin/map_admin','MapController@map_admin');
    Route::get('/admin/map_admin/fetch_data','MapController@fetch_data');
    Route::get('/admin/map_admin/fetch_data2','MapController@fetch_data2');
    Route::post('/admin/map_admin/update_data', 'MapController@update_data')->name('MapController.update_data');
    Route::get('/admin/add_car','AdminController@add_car');
    Route::post('/admin/add_car','AdminController@car_store')->name('car_store');
    Route::post('/admin/car_edit/{cars}','AdminController@car_update')->name('car_update');
    Route::get('/admin/car_delete/{cars}','AdminController@car_delete');
    Route::get('/admin/feedback','AdminController@feedback');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function () {
    return view('about');
});
Route::get('/feedback', function () {
    return view('feedback');
});
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/car_details/{cars}', 'MapController@showCars');
    Route::post('/car_details/{cars}','MapController@statusBooked')->name('status_booked');
    Route::get('/car_details/cancel/{cars}','MapController@cancelStatus');
    Route::post('/car_details/cancel/{cars}','MapController@cancelBooking')->name('cancel_booking');
    //Route::post('/paypal', 'ReportController@createReport')->name('user_report');
    Route::get('/booking_history','ReportController@bookingHistory');
    Route::get('/booking_history/{reports}','ReportController@generateReport');
    Route::get('/car_details/{cars}/payment', 'MapController@showRecipt');
    Route::post('/car_details/{cars}/payment','MapController@statusAvailable')->name('status_available');
    Route::post('/car_details/{cars}/payment/paypal', 'PaymentController@index')->name('user_report');
    
    Route::post('charge', 'PaymentController@charge');
    Route::get('paymentsuccess', 'PaymentController@payment_success');
    Route::get('paymenterror', 'PaymentController@payment_error');
    Route::get('/success_transaction', function() {
        return view('success');
    });
    Route::get('/declined_transaction', function() {
        return view('declined');
    });


});




