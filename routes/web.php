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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')->namespace('admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/restaurants', 'RestaurantController');
    // Route::get('/restaurants/create', 'RestaurantController@create')->name('restaurants.create');
    // Route::post('/restaurants', 'RestaurantController@store')->name('restaurants.store');
    // Route::get('/restaurants/{slug}/edit', 'RestaurantController@edit')->name('restaurants.edit');
    // Route::put('/restaurants/{slug}', 'RestaurantController@update')->name('restaurants.update');
});
