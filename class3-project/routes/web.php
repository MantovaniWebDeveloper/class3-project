<?php
	
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/
	//TEST DARIO
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/result', 'HomeController@result')->name('result');
	
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/
	//TEST EMANUELE
	
	Auth::routes();
	
	Route::get('/home', 'HomeController@index')->name('home');
	
	//rotte di test
	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch');
	Route::get('/', 'ApartmentController@index');
	Route::get('/token', 'ApartmentController@showToken');
	
	//TEST DAVIDE
	Route::get(
	  '/', function () {
		return view('index');
	});

