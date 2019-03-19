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
	//test dario
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
	//test emanuele
	
	Auth::routes();
	
	Route::get('/home', 'HomeController@index')->name('home');
	
	//ROTTE DI TEST
	Route::get('/appartamenti/ricerca', 'ApartmentController@simpleSearch');
	Route::get('/', 'ApartmentController@index');
	Route::get('/token', 'ApartmentController@showToken');

