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

Route::post('storeArticle', 'ArticlesController@store');
Route::get('getArticles', 'ArticlesController@index');
Route::post('updateArticle/{id}', 'ArticlesController@update');
Route::get('showArticle/{id}', 'ArticlesController@show');
Route::post('deleteArticle/{id}', 'ArticlesController@destroy');
Route::post('signUp','UsersController@signUp');





Route::any('{path?}', 'UsersController@index')->where("path", ".+"); // always make last Route in list
