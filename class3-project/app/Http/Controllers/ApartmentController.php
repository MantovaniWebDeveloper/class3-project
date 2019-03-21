<?php

	namespace App\Http\Controllers;

	use App\Apartment;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
<<<<<<< HEAD
	use Illuminate\Support\Facades\DB;

=======
	
>>>>>>> emanuele
	class ApartmentController extends Controller {

		/*
		 * Ritorna la homepage con un 1 appartamento in offerta,
		 * n appartamenti in evidenza e
		 */
		function index() {
			$utc = Carbon::now('Europe/Rome');
			$promoApartmentsToShow = 5;
			try {
				//un appartamento scontato da mostrare nell'hero della home
				$saleApartment = Apartment::isShowed()->where('sale', '>', 0)->inRandomOrder()->first();
				//collection di appartamenti sponsorizzati
				$promoApartments = Apartment::isShowed()->where('end_promo', '>', $utc)->orderBy('end_promo', 'asc')->take($promoApartmentsToShow)->get();
				//genero array di regioni per ricerche precompilate
				$rawData = \Config::get('regions');
				shuffle($rawData);
				$regionsToTake = 5;
				$regions = array_slice($rawData, 0, $regionsToTake, true);;
				//TODO la view finale è index
				return view('emanuele')
				  ->withRegions($regions)
				  ->withSaleApartment($saleApartment->toArray())
				  ->withPromoApartments($promoApartments);
			} catch (\Exception $e) {
				return abort(500);
			}
		}

		/*
		 * Questo metodo viene chiamato dal submit del form nella homepage
		 */
		function simpleSearch(Request $request) {
			if (!$request->has('city_code') || !$request->has('bed_count')) {
				abort(404);
			}
			//recupero coordinate della città
			$rawData = \Config::get('cities');
			$radius = 20;
			$pagination = 10;
			$cityId = $request->input('city_code');
			try {
				
				$lat = $rawData[$cityId]['lat'];
				$lng = $rawData[$cityId]['lng'];
				$bedCount = $request->input('bed_count');
				$apartments = Apartment::findInRange($radius, $lat, $lng)->isShowed()->where('bed_count', '>=', $bedCount)->paginate($pagination);
				return view('result')
				  ->withApartments($apartments->toArray())
				  ->withSearchType('city')
				  ->withSearchLabel($rawData[$cityId]['provincia']);
			} catch (\Exception $e) {
				return abort(500);
			}
		}

		function showAdvancedSearch() {
<<<<<<< HEAD
			$utc = Carbon::now('Europe/Rome');
			try {
				$promoApartments = Apartment::where('end_promo', '>', $utc)->orderBy('end_promo', 'asc')->take(5)->get();
				return view('result')->withPromoApartments($promoApartments);
			} catch (\Exception $e) {
				return abort(500);
			}
		}

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
=======
		
>>>>>>> emanuele
		}

		function advancedSearch(Request $request) {
			return "TODO";
		}
<<<<<<< HEAD

=======
		
		/*
		 * questo metodo restituisce un array di appartamenti che sono compresi
		 * all'interno di un raggio [$radius] di ogni provincia della regione
		 * passata nella request tramite [region_code] dove
		 * 1 <= [region_code] <= 20
		 */
		function regionSearch(Request $request) {
			$validator = \Validator::make(
			  $request->all(), [
			  'region_code' => 'required|integer|between:1,20'
			]);
			if ($validator->fails()) {
				abort(404);
			};
			try {
				//ottengo il codice regio
				$regionCode = $request->input('region_code');
				//ottengo array delle città e delle regioni dalla config
				$rawDataCities = \Config::get('cities');
				$rawDataRegions = \Config::get('regions');
				$index = array_search($regionCode, array_column($rawDataRegions, 'id_regione'));
				$regionName = $rawDataRegions[$index]['nome'];
				//filtro array per includere solo le province della regione passata
				$cities = array_filter(
				  $rawDataCities, function ($item) use ($regionCode) {
					return $item['id_regione'] == $regionCode ? true : false;
				});
				//imposto raggio di ricerca e paginazione
				$radius = 20;
				//array contenente i risultati
				$results = [];
				foreach ($cities as $city) {
					$data = Apartment::findInRange($radius, $city['lat'], $city['lng']);
					$data = $data->toArray();
					$results = array_merge($results, $data);
				}
				//ora $results potrà contenere dei valori duplicati che vado a eliminare in base
				//allo slug che è univoco per ogni appartamento
				$tempArr = array_unique(array_column($results, 'slug'));
				$results = array_intersect_key($results, $tempArr);
				return view('result')
				  ->withApartments($results)
				  ->withSearchType('region')
				  ->withSearchLabel($regionName);
			} catch (\Exception $e) {
				abort(500);
			}
		}
		
>>>>>>> emanuele
	}
