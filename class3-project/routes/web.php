<?php
	
	use Illuminate\Http\Request;
	
	Route::get('/', 'ApartmentController@index')->name('home');
	
	//	Route::post('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca');
	//	Route::get('/appartamenti/ricerca', 'ApartmentController@showAdvancedSearch')->name('ricerca_avanzata');
	//	Route::get('/test', function(Request $request){
	//		dd($request->all());
	//	})->name('test');
	
	//<<<<<<< HEAD
	//=======
	//
	//
	//
	//
	//>>>>>>> davide
	//	//TEST DARIO
	////	Route::get('/result', 'HomeController@result')->name('result');
	//
	///*	Auth::routes();
	//
	//	Route::get('/home', 'HomeController@index')->name('home');
	//*/
	//	//rotte di test
	////	Route::get('/', 'ApartmentController@index');
	////	Route::get('/token', 'ApartmentController@showToken');
	//
	//	//TEST DAVIDE
	//	Route::get('/html', function() {
	//		return view('html.index-raw');
	//	});;
	
	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca_avanzata');
	
	Route::get('/appartamenti/regione', 'ApartmentController@regionSearch')->name('ricerca_regione');
	


