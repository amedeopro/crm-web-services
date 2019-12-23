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

// visualizzazione
Route::get('/customers','Api\CustomerController@index');
Route::get('/customers/contaclienti','Api\CustomerController@contaClienti');
Route::get('/works','Api\WorkController@index');
Route::get('/works/contalavori','Api\WorkController@contaLavori');
Route::get('/users','Api\UserController@index');

// modifica
Route::get('/works/{id}','Api\WorkController@edit');
Route::patch('/works/{id}','Api\WorkController@update');
Route::get('/customers/{id}','Api\CustomerController@edit');
Route::patch('/customers/{id}','Api\CustomerController@update');

// inserimento
Route::post('/customers','Api\CustomerController@create');
Route::post('/works','Api\WorkController@create');

// delete
Route::delete('works/{id}', 'Api\WorkController@destroy');
Route::delete('customers/{id}', 'Api\CustomerController@destroy');

