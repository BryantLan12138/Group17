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

Auth::routes();

Route::group(['middleware' => ['auth' => 'isadmin']], function()
{
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/cars_management','AdminController@cars_management');
    Route::get('/admin/orders_management','AdminController@orders_management');
    Route::get('/admin/users_management','AdminController@users_management');
    Route::get('/admin/cars_management/{cars}', 'AdminController@car_edit');
    Route::get('/admin/add_car','AdminController@add_car');
    Route::post('/admin/add_car','AdminController@car_store')->name('car_store');
    Route::post('/admin/car_edit/{cars}','AdminController@car_update')->name('car_update');
    Route::get('/admin/car_delete/{cars}','AdminController@car_delete');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/car_details/{cars}', 'MapController@showCars');
Route::post('/car_details/{cars}','MapController@statusBooked')->name('status_booked');

Route::get('/car_details/{cars}/payment', 'MapController@showRecipt');
Route::post('/car_details/{cars}/payment','MapController@statusAvailable')->name('status_available');

Route::get('/about', function () {
    return view('about');
});


Route::get('/paypal', function () {
    return view('paypal');
});








