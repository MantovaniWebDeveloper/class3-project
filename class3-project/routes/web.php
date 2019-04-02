<?php

	Route::namespace('Auth')->group(
	  function () {
		  Route::post('/host/crea', 'RegisterController@register');
		  Route::post('/host/login', 'LoginController@login');
		  Route::post('/host/logout', 'LoginController@logout')->middleware('auth')->name('logout');
		  Route::get('/host/login', 'LoginController@showLoginForm')->name('login');
		  Route::get('/host/crea', 'RegisterController@showRegistrationForm')->name('register');
	  });

	Route::get('/', 'ApartmentController@index')->name('home');

	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');

	Route::get('/appartamenti/{slug}', 'ApartmentController@show')->name('appartamento');

	Route::get('/gestione', 'ApartmentController@manageApartments')->name('dashboard');

	Route::get('/nuovo_appartamento', 'ApartmentController@newApartment')->name('nuovo');
	Route::post('/nuovo_appartamento', 'ApartmentController@store')->name('salva.nuovo');



	Route::get('/sponsorizza/{appartamento}', 'ApartmentController@promote')->name('sponsorizza');

	Route::get('/modifica', 'ApartmentController@edit')->name('modifica');
	Route::put('/modifica/{id}', 'ApartmentController@update')->name('salva.modifica');

	Route::get('/statistiche/{slug}', 'ApartmentController@stats')->name('statistiche');

	Route::post('/crea_customer/{appartamento}', 'PaymentController@createCustomer')->name('create_customer');

	Route::post('/appartament/{slug}/messaggio', 'MessageController@sendMessage')->name('send_message');
