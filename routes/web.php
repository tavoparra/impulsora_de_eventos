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
Route::pattern('id', '[0-9]+');

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// Users
Route::group(['prefix' => 'users', 'middleware' => ['auth']], function() {
    Route::get('/', 'UserController@list');
    Route::get('/create', 'UserController@create');
    Route::get('/{user}', 'UserController@detail')->where('user', '[A-Za-z0-9._-]+');
    Route::post('/save/{id?}', 'UserController@save');
});

// Categories
Route::group(['prefix' => 'categories', 'middleware' => ['auth']], function() {
    Route::get('/', 'CategoryController@list');
    Route::get('/{id}', 'CategoryController@detail');
    Route::get('/create', 'CategoryController@create');
    Route::post('/save/{id?}', 'CategoryController@save');
});

// Products
Route::group(['prefix' => 'products', 'middleware' => ['auth']], function() {
    Route::get('/', 'ProductController@list');
    Route::get('/{id}', 'ProductController@detail');
    Route::get('/create', 'ProductController@create');
    Route::post('/save/{id?}', 'ProductController@save');
});

// Packages
Route::group(['prefix' => 'packages', 'middleware' => ['auth']], function() {
    Route::get('/', 'PackageController@list');
    Route::get('/{id}', 'PackageController@detail');
    Route::get('/create', 'PackageController@create');
    Route::post('/save/{id?}', 'PackageController@save');
});

// Reservations
Route::group(['prefix' => 'reservations', 'middleware' => ['auth']], function() {
    Route::get('/', 'ReservationController@list');
    Route::get('/{id}', 'ReservationController@detail');
    Route::get('/create', 'ReservationController@create');
    Route::post('/save/{id?}', 'ReservationController@save');
});
