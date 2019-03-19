<?php

	//TEST DARIO
	Route::get('/', 'ApartmentController@index')->name('home');
	Route::get('/result', 'HomeController@result')->name('result');


	//TEST EMANUELE

/*	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
*/
	//rotte di test
	Route::post('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca');
//	Route::get('/', 'ApartmentController@index');
//	Route::get('/token', 'ApartmentController@showToken');

	//TEST DAVIDE
/*	Route::get(
	  '/', function () {
		return view('index');
	});*/
