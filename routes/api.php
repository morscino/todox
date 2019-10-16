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

Route::post('/register','UserController@register');
Route::post('/login','UserController@login');

Route::post('todo/create','TodoController@create');
Route::get('todos','TodoController@show');
Route::put('todo/edit/{id}','TodoController@edit');
Route::delete('todo/delete/{id}','TodoController@destroy');

