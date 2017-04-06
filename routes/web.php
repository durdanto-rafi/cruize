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

Route::resource('/', 'CruizeController');

Route::resource('cruize', 'CruizeController');
Route::get('excersion/{id}/add', ['as'=> 'excersion.add', 'uses'=>'CruizeController@getExcersion']);
Route::get('guest/{id}/add', ['as'=> 'guest.add', 'uses'=>'CruizeController@getGuest']);
Route::get('importExport', 'CruizeController@importExport');
Route::get('downloadExcel/{type}', 'CruizeController@downloadExcel');
Route::post('importExcel', 'CruizeController@importExcel');

Route::resource('excursion', 'ExcursionController');

Route::resource('guest', 'GuestController');