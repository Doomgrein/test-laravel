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

Route::get('/', 'IndexController@index');

Route::resource('articles', 'ArticleController');
Route::resource('users', 'UserController');
Route::post('articles/{article}/restore', 'ArticleController@restore')->name('articles.restore');