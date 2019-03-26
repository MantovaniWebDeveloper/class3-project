<?php

	use Illuminate\Http\Request;

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
