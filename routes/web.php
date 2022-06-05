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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home','ProductController@index');
Route::get('/register','RegisterController@registerForm');
Route::post('/register','RegisterController@register');
Route::get('/login','LoginController@loginForm');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');
Route::get('addProduct','AddProductController@callAddProduct');
Route::post('addProduct','AddProductController@addProduct');
Route::get('addToCart/{id}','ProductController@addToCart');
Route::get('cartData/{user}','ProductController@cartData');
Route::get('cart/{user}','ProductController@displayCartData');
Route::get('refresh','ProductController@quantityUpdate');
Route::get('delete/{product_id}','ProductController@quantitydelete');
Route::get('payment/{lodin_id}', 'StripeController@handleGet');
Route::post('payment', 'StripeController@handlePost')->name('product.payment');
Route::get('payment', function(){
    return redirect('home')->with('msg','payment successfull plz check your Myorder List and Mail');
});
Route::get('order/{user}','ProductController@myOrder');


