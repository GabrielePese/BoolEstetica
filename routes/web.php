<?php

use Illuminate\Support\Facades\Route;




Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profilo{id}', 'LoggedController@profilo')->name('profilo');
Route::get('/show-tratt/{id}', 'HomeController@showTratt')->name('show-tratt');
Route::get('/create-tratt', 'LoggedController@createTratt')->name('create-tratt');
Route::post('/store-tratt', 'LoggedController@storeTratt')->name('store-tratt');
Route::get('/prenota/{id}', 'LoggedController@prenota')->name('prenota');
Route::post('/prenotastore/{id}', 'LoggedController@prenotastore')->name('prenota-post');
Route::get('/promo/{id}', 'LoggedController@promo')->name('promo');
Route::post('/aggiungipromo/{id}' , 'LoggedController@aggiungipromo')->name('aggiungipromo');
Route::get('/create-promo', 'LoggedController@createpromo')->name('create-promo');
Route::post('/create-promo-store', 'LoggedController@createpromostore')->name('create-promo-store');
Route::get('/scrivirecensione/{id}', 'LoggedController@scrivirecensione')->name('scrivirecensione');
Route::post('/recensione-post/{id}', 'LoggedController@recensionepost')->name('recensione-post');
