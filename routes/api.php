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

Route::post("/products","CartController@all_products");
Route::post("/add_cart","CartController@add_cart");
Route::post("/add_cart","CartController@add_cart");
Route::post("/remove_cart_item","CartController@remove_cart_item");
Route::post("/my_cart","CartController@my_cart");
Route::post("/auth","AuthController@auth");
