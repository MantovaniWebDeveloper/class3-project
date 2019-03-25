<?php
	
	use Illuminate\Http\Request;
	
	//	Auth::routes();
	
	Route::namespace('Auth')->group(
	  function () {
		  Route::post('/host/crea', 'RegisterController@register');
		  Route::post('/host/login', 'LoginController@login');
		  Route::post('/host/logout', 'LoginController@logout')->name('logout');
		  Route::get('/host/login', 'LoginController@showLoginForm')->name('login');
		  Route::get('/host/crea', 'RegisterController@showRegistrationForm')->name('register');
	  });
	
	Route::get('/', 'ApartmentController@index')->name('home');
	
	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');
	
	Route::get('/appartamenti/{slug}', 'ApartmentController@show')->name('appartamento');
	