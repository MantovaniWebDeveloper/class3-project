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
		  Route::get('/customer/token', 'PaymentController@getCustomerToken');
		  Route::get('/address/search', 'ApartmentController@getAddressesFromUserSearch');
		  Route::get('/address/search/map', 'ApartmentController@getMapFromCoordinates');
		  Route::post('/sponsorizza/checkout', 'PaymentController@checkout');
		  Route::get('/apartment/stats', 'ApartmentController@stats');
	  });
