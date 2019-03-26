<?php

	use Illuminate\Http\Request;
	Auth::routes();

	Route::get('/', 'ApartmentController@index')->name('home');

	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');
