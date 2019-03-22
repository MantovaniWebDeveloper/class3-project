<?php
	
	namespace App\Http\Controllers;
	
	use App\Apartment;
	use App\Service;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
	use GuzzleHttp\Client;
	
	class ApartmentController extends Controller {
		
		private $client;
		
		public function __construct() {
			
			$this->client = new Client(
			  [
				'base_uri' => 'https://api.tomtom.com'
			  ]);
		}
		
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
				//nella home oltre agli appartamenti in evidenza ci saranno dei capoluoghi di provincia
				//per ricerche in città preconfezionate
				$rawData = \Config::get('cities');
				$mainCities = array_filter(
				  $rawData, function ($city) {
					return array_key_exists("capoluogo", $city);
					
				});
				shuffle($mainCities);
				$regionsToTake = 5;
				$mainCities = array_slice($mainCities, 0, $regionsToTake, false);
				//recupero indirizzi
				foreach ($promoApartments as $promoApartment) {
					$reverseAddress = $this->getAddress($promoApartment->latitude, $promoApartment->longitude);
					$promoApartment->address = $reverseAddress;
				}
				return view('index')
				  ->withMainCities($mainCities)
				  ->withSaleApartment($saleApartment)
				  ->withPromoApartments($promoApartments);
			} catch (\Exception $e) {
				return abort(500);
			}
		}
		
		private function getAddress($latitude, $longitude) {
			try {
				$uri = "/search/2/reverseGeocode/$latitude,$longitude.json";
				$response = $this->client->request(
				  'GET',
				  $uri, [
					'query' => [
					  'key' => 'rUTrqh7oaVBjDuzbkoBbTeQleSlTjRGj'
					],
					'headers' => [
					  'Accept' => '*/*'
					]
				  ]);
				$decodedJson = json_decode($response->getBody()->getContents(), true);
				if (array_key_exists('streetName', $decodedJson['addresses'][0]['address'])) {
					$streetName = $decodedJson['addresses'][0]['address']['streetName'] . ', ';
				}else{
					$streetName='';
				};
				if (array_key_exists('municipality',$decodedJson['addresses'][0]['address'])) {
					$municip = $decodedJson['addresses'][0]['address']['municipality'] . ', ';
				}else{
					$municip='';
				};
				if (array_key_exists('postalCode', $decodedJson['addresses'][0]['address'])) {
					$pcode = $decodedJson['addresses'][0]['address']['postalCode'] . ', ';
				}else{
					$pcode='';
				};
				if (array_key_exists('countrySecondarySubdivision',$decodedJson['addresses'][0]['address'])) {
					$province = $decodedJson['addresses'][0]['address']['countrySecondarySubdivision'] . ', ';
				}else{
					$province='';
				};
				return "$streetName $municip $pcode $province";
			} catch (\Exception $e) {
				return 'N/A';
			}
			
		}
		
		/*
		 * Questo metodo viene chiamato dal submit del form nella homepage
		 */
		function simpleSearch(Request $request) {
			if (!$request->has('city_code') || !$request->has('bed_count')) {
				//todo non deve abortire ma tornare la view
				//todo che a sua volta verifica la non presenza di dati e rileva la posizione dell'utente
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
				$apartments = Apartment::findInRange($radius, $lat, $lng)->isShowed()->where('bed_count', '>=', $bedCount)->get();
				$services = Service::orderBy('name')->get();
				return view('result')
				  ->withApartments($apartments)
				  ->withServices($services)
				  ->withcityName($rawData[$cityId]['provincia']);
			} catch (\Exception $e) {
				return abort(500);
			}
		}
		
	}
