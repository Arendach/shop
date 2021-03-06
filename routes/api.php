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

Route::post('new_post/search_cities', "Api\NewPostController@searchCities");
Route::post('new_post/get_warehouses', "Api\NewPostController@getWarehouses");

Route::post('new_post/search_streets', "Api\NewPostController@searchStreets");
Route::post('new_post/get_payment', "Api\NewPostController@getPayment");
