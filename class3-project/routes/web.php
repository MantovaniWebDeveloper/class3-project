<?php



	Route::get('/', 'ApartmentController@index')->name('home');

	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');

	Route::get('/appartamenti/regione', 'ApartmentController@regionSearch')->name('ricerca_regione');
	


