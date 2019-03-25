<?php

	namespace App\Http\Controllers;

	use App\Apartment;
	use App\Service;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
	use App\Traits\ReverseGeo;

	class ApartmentController extends Controller {

		use ReverseGeo;

		/*
		 * Ritorna la homepage con un 1 appartamento in offerta,
		 * n appartamenti in evidenza e
		 */
		function index() {
			$utc = Carbon::now('Europe/Rome');
			$promoApartmentsToShow = 4;
			try {
				//un appartamento scontato da mostrare nell'hero della home
				$saleApartment = Apartment::isShowed()->where('sale', '>', 0)->inRandomOrder()->first();
				//collection di appartamenti sponsorizzati
				$promoApartments = Apartment::isShowed()->where('end_promo', '>', $utc)->orderBy('end_promo', 'asc')->take($promoApartmentsToShow)->get();
				//nella home oltre agli appartamenti in evidenza ci saranno dei capoluoghi di provincia
				//per ricerche in città preconfezionate
				$rawData = \Config::get('cities');
				$mainCities = array_filter(
				  $rawData, function ($city) {
					return array_key_exists("capoluogo", $city);

				});
				$filteredMainCities=[];
				foreach ($mainCities as $key => $mainCity){
					$filteredMainCities[]=['city_code'=>$key, 'city_name'=>$mainCity['provincia']];
				}
				shuffle($filteredMainCities);
				$mainCitiesToTake = 5;
				$mainCities = array_slice($filteredMainCities, 0, $mainCitiesToTake, false);
				//recupero indirizzi
				$this->collectAddress($promoApartments);
				return view('index')
				  ->withMainCities($mainCities)
				  ->withSaleApartment($saleApartment)
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
				//todo
				// non deve abortire ma tornare la view che a sua volta
				// verifica la non presenza di dati e rileva la posizione dell'utente
				abort(404);
			}
			//recupero coordinate della città
			$rawData = \Config::get('cities');
			$radius = 20;
			//todo da fare la paginazione
			$pagination = 10;
			$cityId = $request->input('city_code');
			try {

				$lat = $rawData[$cityId]['lat'];
				$lng = $rawData[$cityId]['lng'];
				$bedCount = $request->input('bed_count');
				$apartments = Apartment::findInRange($radius, $lat, $lng, true)->isShowed()->where('bed_count', '>=', $bedCount)->get();
				//recupero indirizzi
				$this->collectAddress($apartments);
				$services = Service::orderBy('name')->get();
				return view('result')
				  ->withApartments($apartments)
				  ->withServices($services)
				  ->withcityName($rawData[$cityId]['provincia']);
			} catch (\Exception $e) {
				return abort(500);
			}
		}

		private function collectAddress(&$collection){
			//recupero indirizzi
			foreach ($collection as $item) {
				$reverseAddress = $this->getAddress($item->latitude, $item->longitude);
				$item->address = $reverseAddress;
			}
		}

	}
