<?php
	
	use Illuminate\Http\Request;
	
	Route::middleware('auth:api')->get(
	  '/user', function (Request $request) {
		return $request->user();
	});
	
	Route::namespace('Api')->middleware('only_ajax')->group(
	  function () {
		  Route::get('/cities', 'ApartmentController@cities');
		  Route::get('/search', 'ApartmentController@advancedSearch');
	  }
	);
	
	Route::namespace('Auth\Api')->middleware('auth:api')->group(
	  function () {
		  Route::patch('/apartment/visibility', 'ApartmentController@setVisibility');
		  Route::delete('/apartment/delete', 'ApartmentController@delete');
	  });
