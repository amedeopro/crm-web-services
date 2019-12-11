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

Route::get('/customers','Api\CustomerController@index');
Route::get('/customers/contaclienti','Api\CustomerController@contaClienti');
Route::get('/works','Api\WorkController@index');
Route::get('/works/contalavori','Api\WorkController@contaLavori');
Route::get('/users','Api\UserController@index');


Route::post('/customers','Api\CustomerController@create');
Route::post('/works','Api\WorkController@create');
