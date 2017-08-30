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

Route::get('/', function () {
    $model = \App\Product::all();
    return view('welcome', ['model' => $model]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'HomeController@profile')->name('profile')->middleware('auth');

Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('/basket', 'BasketController@getBasket')->name('basket')->middleware('auth');

Route::get('/order/{id}', 'BasketController@addToBasket')->name('addToBasket')->middleware('auth');
