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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('itemCRUD', 'ItemCRUDController');

Route::resource('cruize', 'CruizeController');
Route::get('excersion/{id}/add', ['as'=> 'excersion.add', 'uses'=>'CruizeController@getExcersion']);

Route::resource('excursion', 'ExcursionController');


Route::resource('guest', 'GuestController');