<?php

use Illuminate\Http\Request;

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('getdetails', 'API\UserController@details');
    Route::get('category', 'API\UserController@category');
    Route::get('product/{name?}', 'API\UserController@products');
    Route::get('productbycategory/{id}', 'API\UserController@productbycategory');

    Route::get('product_details/{id}', 'API\UserController@productdetails');
    Route::get('city', 'API\UserController@city');
    Route::get('sector/{city}', 'API\UserController@sector');
    Route::get('apartment/{sector}', 'API\UserController@apartment');

    Route::post('save_order', 'API\UserController@save_order');
    Route::post('update_profile', 'API\UserController@update_profile');

    Route::get('orders', 'API\UserController@orders');
    Route::get('order/details/{id}', 'API\UserController@order_details');
});