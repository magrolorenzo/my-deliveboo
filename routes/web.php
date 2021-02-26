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
Route::get('/show/{slug}', 'HomeController@show')->name('guest.show');

Route::get('/checkout', 'PaymentController@checkout')->name('guest.checkout');
Route::post('/pay-and-order', 'PaymentController@pay_and_order')->name('guest.pay');

Route::middleware('auth')->namespace('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/orders', 'OrderController@index')->name('orders');

    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/dishes', 'DishController');
    Route::get('/orders', 'OrderController@index')->name('orders');
});

// Rotte per pagamento braintree
// Route::get('/', 'PaymentController@checkout');
// Route::post('/', 'PaymentController@checkout');
