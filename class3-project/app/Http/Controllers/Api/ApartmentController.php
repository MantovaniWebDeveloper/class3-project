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
		
		function spaSearch(Request $request) {
			$validator = \Validator::make(
			  $request->all(), [
			  'city_code' => 'required|integer',
			  'room_count' => 'required|integer',
			  'bed_count' => 'required|integer',
			  'radius' => 'required|integer|between:20,100',
			  'services' => 'array',
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
			$apartments = $builder->get();
			return $apartments->toJson();
		}
	}
