<?php

	namespace App\Http\Controllers\Api;

	use App\Apartment;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Validation\Rule;

	class ApartmentController extends Controller {

		function cities() {

			$rawData = \Config::get('cities');
			$cities = [];
			foreach ($rawData as $index => $data) {
				$cities[] = [
				  'name' => $data['provincia'],
				  'code' => $index
				];
			}
			return $cities;
		}

		function advancedSearch(Request $request) {
			$validator = \Validator::make(
			  $request->all(), [
			  'city_code' => 'required|integer',
			  'room_count' => 'required|integer',
			  'bed_count' => 'required|integer',
			  'radius' => 'required|integer|between:10,100',
			  'services' => 'array',
			  'price_range' => 'array',
			  'order_type' => [
				'required', 'string',
				Rule::in(['distance', 'price']),
			  ]
			]);
			if ($validator->fails()) {
				return 'macello - dati non validi';
			}
			$rawData = \Config::get('cities');
			$cityId = $request->input('city_code');
			$lat = $rawData[$cityId]['lat'];
			$lng = $rawData[$cityId]['lng'];
			$bedCount = $request->input('bed_count');
			$roomCount = $request->input('room_count');
			$radius = $request->input('radius');
			$builder = Apartment::findInRange($radius, $lat, $lng)
			  ->isShowed()
			  ->where([['bed_count', '>=', $bedCount], ['room_count', '>=', $roomCount]]);
			if ($request->has('services')) {
				$services = $request->input('services');
				foreach ($services as $service) {
					$builder->whereHas(
					  'services', function ($query) use ($service) {
						$query->where('services.id', '=', $service);
					});
				}
			}
			if ($request->has('price_range')) {
				$prices = $request->input('price_range');
				$builder->where(
				  function ($query) use ($prices) {
					  foreach ($prices as $key => $price) {
						  //$price può assumere 0,1,2
						  switch ($price) {
							  case 0:
								  //0=0..50
								  if ($key == 0) {
									  $query->where('price', '<=', 50);
								  } else {
									  $query->orWhere('price', '<=', 50);
								  }
								  break;
							  case 1:
								  //1=50..100
								  if ($key == 0) {
									  $query->where('price', '>=', 50)->orWhere('price', '<=', 100);
								  } else {
									  $query->orWhere('price', '>=', 50)->orWhere('price', '<=', 100);
								  }
								  break;
							  default:
								  //2=100+
								  if ($key == 0) {
									  $query->where('price', '>', 100);
								  } else {
									  $query->orWhere('price', '>', 100);
								  }
						  }
					  }
				  });

			}

//			dd($builder->toSql());
			$apartments = $builder->get();
			return $apartments->toJson();
		}
	}
