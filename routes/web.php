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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/sets', 'setsController@index');
Route::post('/sets', 'setsController@store');
Route::get('/set/edit/{id}', 'setsController@edit');
Route::post('/set/edit/{id}', 'setsController@update');
Route::get('/set/delete/{id}', 'setsController@delete');
Route::get('/set/enable/{id}', 'setsController@enable');
Route::get('/set/disable/{id}', 'setsController@disable');
