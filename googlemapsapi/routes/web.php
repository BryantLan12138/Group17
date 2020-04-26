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
}
);

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/car_details/{cars}','MapController@map_new');
Route::get('/car_details/{cars}','MapController@showCars');











