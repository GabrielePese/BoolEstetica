<?php

use Illuminate\Support\Facades\Route;
    




Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/profilo{id}', 'LoggedController@profilo')->name('profilo');
Route::get('/chisiamo', 'HomeController@chisiamo')->name('chisiamo');
Route::get('/contatti', 'HomeController@contatti')->name('contatti');
Route::post('/email', 'HomeController@email')->name('email');


Route::get('/show-tratt/{id}', 'HomeController@showTratt')->name('show-tratt');
Route::get('/create-tratt', 'LoggedController@createTratt')->name('create-tratt');
Route::post('/store-tratt', 'LoggedController@storeTratt')->name('store-tratt');
Route::get('/prenota/{id}', 'LoggedController@prenota')->name('prenota');
Route::post('/prenotastore/{id}', 'LoggedController@prenotastore')->name('prenota-post');

Route::get('/impostaferieGet/{id}', 'LoggedController@impostaferieGet')->name('impostaferieGet');
Route::post('/impostaferie/{id}', 'LoggedController@impostaferie')->name('impostaferie');

Route::get('/promo/{id}', 'LoggedController@promo')->name('promo');
Route::post('/aggiungipromo/{id}' , 'LoggedController@aggiungipromo')->name('aggiungipromo');

Route::get('/create-promo', 'LoggedController@createpromo')->name('create-promo');
Route::post('/create-promo-store', 'LoggedController@createpromostore')->name('create-promo-store');

Route::get('/scrivirecensione/{idPrenotazione}', 'LoggedController@scrivirecensione')->name('scrivirecensione');
Route::post('/recensione-post/{idPrenotazione}', 'LoggedController@recensionepost')->name('recensione-post');

Route::get('/anuullaapp/{idPrenotazione}', 'LoggedController@annullaprenotaz')-> name ('anulla-app');

Route::get('/visualizzaCalendario', 'LoggedController@visualizzaCalendario')-> name ('visualizzaCalendario');

Route::get('/apiCalendar', 'LoggedController@apiCalendar')-> name ('apiCalendar');

Route::get('/apiCalendarioData/{valoreinput}', 'LoggedController@apiCalendarioData') -> name('APIcalendarioData');


Route::get('/statistiche', 'LoggedController@statistiche')-> name ('statistiche');
Route::get('/apiStatistiche/{idUtenteSelezionato}', 'LoggedController@apiStatistiche') -> name('apiStatistiche');
Route::get('/apiFatturatoMeseChart', 'LoggedController@fatturatoMeseChart') -> name('fatturatoMeseChart');

Route::get('/trattamenti', 'HomeController@trattamenti')-> name ('trattamenti');
Route::get('/trattamentiRelax', 'HomeController@trattamentiRelax')-> name ('trattamentiRelax');
Route::get('/trattamentiEstetica', 'HomeController@trattamentiEstetica')-> name ('trattamentiEstetica');
Route::get('/trattamentiDeco', 'HomeController@trattamentiDeco')-> name ('trattamentiDeco');


