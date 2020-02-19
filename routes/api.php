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

Route::apiResource('users','UserController');
Route::put('user/cambiartoken','UserController@cambiarToken')->name('users.token');

Route::apiResource('products', 'ProductController');
Route::get('myproducts','ProductController@myproducts')->name('products.my');
Route::get('product/sellers','ProductController@productsSellers')->name('products.sellers');

Route::apiResource('transactions', 'TransactionController');

Route::apiResource('categories', 'CategoryController');
Route::get('category/products','CategoryController@categoryProducts')->name('category.products');
Route::get('mycategories','CategoryController@myCategories')->name('categories.my');
