<?php
	
	use Illuminate\Http\Request;
	
	Route::get('/', 'ApartmentController@index')->name('home');
	
	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');
	