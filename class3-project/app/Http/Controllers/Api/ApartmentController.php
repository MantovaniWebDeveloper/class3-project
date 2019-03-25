<?php
	
	namespace App\Http\Controllers\Api;
	
	use App\Apartment;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Validation\Rule;
	use App\Traits\ReverseGeo;
	
	class ApartmentController extends Controller {
		
		use ReverseGeo;
		
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
			//validazione
			$validator = \Validator::make(
			  $request->all(), [
			  'city_code' => 'required|integer',
			  'room_count' => 'required|integer',
			  'bed_count' => 'required|integer',
			  'radius' => 'required|integer|between:10,100',
			  'services' => 'array',
			  'price_range' => [
				'integer',
				Rule::in([1, 10, 11, 100, 101, 110, 111]),
			  ],
			  'order_type' => [
				'required', 'string',
				Rule::in(['distance', 'price']),
			  ]
			]);
			//messaggio di incoraggiamento in caso di errore
			if ($validator->fails()) {
				return 'macello - dati non validi';
			}
			//recupero valori
			$rawData = \Config::get('cities');
			$cityId = $request->input('city_code');
			$lat = $rawData[$cityId]['lat'];
			$lng = $rawData[$cityId]['lng'];
			$bedCount = $request->input('bed_count');
			$roomCount = $request->input('room_count');
			$radius = $request->input('radius');
			$orderBy = $request->input('order_type');
			//costruzione del builder con raggio in km e di soli appartamenti visualizzati
			$builder = Apartment::findInRange($radius, $lat, $lng, ($orderBy == 'price') ? false : true)
			  ->isShowed()
			  ->where([['bed_count', '>=', $bedCount], ['room_count', '>=', $roomCount]]);
			//aggiunta filtri per i servizi
			if ($request->has('services')) {
				$services = $request->input('services');
				foreach ($services as $service) {
					$builder->whereHas(
					  'services', function ($query) use ($service) {
						$query->where('services.id', '=', $service);
					});
				}
			}
			//aggiunta filtro per range di prezzo
			if ($request->has('price_range')) {
				$prices = $request->input('price_range');
				switch ($prices) {
					case 1:
						$builder->where('price', '<=', 50);
						break;
					case 10:
						$builder->whereBetween('price', [50, 100]);
						break;
					case 11:
						$builder->whereBetween('price', [0, 100]);
						break;
					case 100:
						$builder->where('price', '>', 100);
						break;
					case 101:
						$builder->where(
						  function ($query) {
							  $query->orWhere('price', '<=', 50);
							  $query->orWhere('price', '>', 100);
						  });
						break;
					case 110:
						$builder->where('price', '>', 50);
						break;
					default:
						$builder->where('price', '>', 0);
						break;
				}
			}
			//ordinamento
			if ($orderBy == 'price') {
				$builder->orderBy('price');
			}
			//ottenimento risultati
			$apartments = $builder->get();
			//recupero indirizzi
			$this->collectAddresses($apartments);
			return $apartments->toJson();
		}
	}
