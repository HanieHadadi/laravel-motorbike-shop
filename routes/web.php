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

// Route::get('/', function () {
//     return view('product/product');
// });
Route::get('/', 'ProductController@index');
Route::post('/insert', 'ProductController@registerNewProduct');
Route::post('/detail', 'ProductDetailController@registerNewDetail');
Route::post ('/detailValue', 'ProductDetailValueController@registerNewValue');
Route::post ('/eachDetailVal', 'ProductDetailController@findEachDetail');

Route::get('/insert', 'ProductController@permission');
Route::get('/detail', 'ProductDetailController@permission');
Route::get('/detailValue', 'ProductDetailValueController@permission');
Route::get('/search', 'productController@search');
Route::get('/show/{id}', 'productController@show');
Route::get('abort', 'productController@notfound');

Auth::routes();

Route::get('/home', 'HomeController@index');
