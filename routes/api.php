<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/dishes', 'Api\DishController@index');
Route::get('/dishes/{id}', 'Api\DishController@filterDishes');
Route::get('/categories', 'Api\CategoryController@index');
Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/filtered-restaurants/{id}', 'Api\RestaurantController@filtered');

Route::get('/completed-orders', 'Api\OrderController@index');
Route::get('/user-orders/{user_id}', 'Api\OrderController@getUserOrders');
Route::get('/completed-orders/{id}', 'Api\OrderController@index');
