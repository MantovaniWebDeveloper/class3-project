<?php
use Illuminate\Http\Request;

	//TEST EMANUELE
	Route::get('/', 'ApartmentController@index')->name('home');
	Route::post('/appartamenti/ricerca', 'ApartmentController@simpleSearch')->name('ricerca');
	Route::get('/appartamenti/ricerca', 'ApartmentController@showAdvancedSearch')->name('ricerca_avanzata');
	Route::get('/test', function(Request $request){
		dd($request->all());
	})->name('test');





	//TEST DARIO
//	Route::get('/result', 'HomeController@result')->name('result');

/*	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
*/
	//rotte di test
//	Route::get('/', 'ApartmentController@index');
//	Route::get('/token', 'ApartmentController@showToken');

	//TEST DAVIDE
/*	Route::get(
	  '/', function () {
		return view('index');
	});*/
