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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products', 'APIController@products');
Route::get('categories', 'APIController@category');
Route::post('articles', 'APIController@store');
Route::put('articles/{id}', 'APIController@update');
Route::delete('articles/{id}', 'APIController@delete');
