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


Route::get('/cruizes',[
	'uses' => 'CruizeController@getCruizes'
]);

Route::post('/cruize',[
	'uses' => 'CruizeController@postCruize'
]);

Route::post('/cabin',[
	'uses' => 'CabinController@postCabin'
]);

Route::get('/cabins',[
	'uses' => 'CabinController@getCabins'
]);

Route::post('/excursion',[
	'uses' => 'ExcursionController@postExcursion'
]);

Route::get('/excursions',[
	'uses' => 'ExcursionController@getExcursions'
]);

Route::post('/guest',[
	'uses' => 'GuestController@postGuest'
]);

Route::get('/guests',[
	'uses' => 'GuestController@getGuests'
]);
