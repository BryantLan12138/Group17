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
    Route::get('/cars_management','AdminController@cars_management');
    Route::get('/orders_management','AdminController@orders_management');
    Route::get('/users_management','AdminController@users_management');
    Route::get('/cars_management/{cars}', 'AdminController@cars_update');
    Route::get('/add_car','AdminController@add_car');
    Route::post('/car_store','AdminController@car_store')->name('car_store');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/car_details/{cars}', 'MapController@showCars');

Route::get('/car_details/{cars}/payment', 'MapController@showRecipt');

Route::get('/paypal', function () {
    return view('paypal');
});








