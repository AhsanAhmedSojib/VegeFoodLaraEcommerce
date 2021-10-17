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
Route::get('/','ClientController@home');
Route::get('/cart','ClientController@cart');
Route::get('/shop','ClientController@shop');
Route::get('/checkout','ClientController@checkout');
Route::get('/login','ClientController@login');
Route::get('/signup','ClientController@signup');

Route::get('/addcatagory','CatagoryController@addcatagory');
Route::post('/savecatagory','CatagoryController@savecatagory');
Route::get('/catagories','CatagoryController@catagories');
Route::get('/edit_catagory/{id}','CatagoryController@edit');
Route::post('/updatecatagory','CatagoryController@updatecatagory');
Route::get('/delete/{id}','CatagoryController@delete');
Route::get('/view_by_cat/{name}','CatagoryController@view_by_cat');


Route::get('/admin','AdminController@dashboard');
Route::get('/orders','AdminController@orders');


Route::get('/addproduct','ProductController@addproduct');
Route::get('/products','ProductController@products');
Route::post('/saveproduct','ProductController@saveproduct');
Route::get('/edit_product/{id}','ProductController@editproduct');
Route::post('/updateproduct','ProductController@updateproduct');
Route::get('/delete_product/{id}','ProductController@delete_product');
Route::get('/activate_product/{id}','ProductController@activate_product');
Route::get('/unactivate_product/{id}','ProductController@unactivate_product');


Route::get('/sliders','SliderController@sliders');
Route::get('/addslider','SliderController@addslider');
Route::post('/saveslider','SliderController@saveslider');
Route::get('/edit_slider/{id}','SliderController@edit_slider');
Route::post('/update_slider','SliderController@update_slider');
Route::get('/delete_slider/{id}','SliderController@delete_slider');
Route::get('/activate_slider/{id}','SliderController@activate_slider');
Route::get('/unactivate_slider/{id}','SliderController@unactivate_slider');


   