<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/show-tratt/{id}', 'HomeController@showTratt')->name('show-tratt');
Route::get('/create-tratt', 'LoggedController@createTratt')->name('create-tratt');
Route::post('/store-tratt', 'LoggedController@storeTratt')->name('store-tratt');
Route::get('/prenota/{id}', 'LoggedController@prenota')->name('prenota');
Route::post('/prenotastore', 'LoggedController@prenotastore')->name('prenota-post');

