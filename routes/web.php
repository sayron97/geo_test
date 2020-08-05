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


Route::get('/', 'GeoController@index')->name('geo.index');
Route::get('/list', 'GeoController@getLocations')->name('geo.list');
Route::post('/upload', 'GeoController@upload')->name('geo.upload');
