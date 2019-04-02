<?php

	namespace App\Http\Controllers;

	use App\Apartment;
	use App\Message;
	use App\Service;
	use App\Image;
	use Illuminate\Support\Facades\Storage;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
	use App\Traits\ReverseGeo;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;

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
				$filteredMainCities = [];
				foreach ($mainCities as $key => $mainCity) {
					$filteredMainCities[] = ['city_code' => $key, 'city_name' => $mainCity['provincia']];
				}
				shuffle($filteredMainCities);
				$mainCitiesToTake = 4;
				$mainCities = array_slice($filteredMainCities, 0, $mainCitiesToTake, false);
				//recupero indirizzi
				$this->collectAddresses($promoApartments);
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
				return redirect()->route('home');
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
				$this->collectAddresses($apartments);
				$services = Service::orderBy('name')->get();
				return view('result')
				  ->withApartments($apartments)
				  ->withServices($services)
				  ->withcityName($rawData[$cityId]['provincia']);
			} catch (\Exception $e) {
				return abort(500);
			}
		}

		function show($slug) {

			$apartment = Apartment::where('slug', $slug)->get()->first();
			if (is_null($apartment) || !$apartment->is_showed) {
				abort(404);
			}
			//recupero indirizzo
			$this->collectAddress($apartment);
			//recupero mappa
			$imgData = $this->getMap($apartment->latitude, $apartment->longitude);
			//todo <img src="data:image/png;charset=binary;base64,{!! $image !!}">
			return view('showAppartamento')->withApartment($apartment)->withImage($imgData);
		}

		public function manageApartments() {
			if (!Auth::check()) {
				return redirect()->route('login');
			}
			$user = Auth::user();
			return view('dashboard')->withApartments($user->apartments()->orderBy('apartments.id', 'asc')->get());
		}

		public function newApartment() {
			$services = Service::all();
			$action = 'new_apartment';
			return view('appartamento.edit', compact('services', 'action'));
		}

		public function store(Request $request) {
			// $data = $request->all();

			$validator = $request->validate(
			  [
				'title' => 'required',
				'description' => 'required',
				'square_meters' => 'required',
				'room_count' => 'required',
				'bed_count' => 'required',
				'bathroom_count' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'price' => 'required'
			  ]);

			$validator['user_id'] = Auth::id();
			$apartment = Apartment::create($validator);

			// $apartment = New Apartment;
			// $data['title'] = $apartment->title;
			// $data['description'] = $apartment->description;
			// $data['square_meters'] = $apartment->square_meters;
			// $data['room_count'] = $apartment->room_count;
			// $data['bed_count'] = $apartment->bed_count;
			// $data['bathroom_count'] = $apartment->bathroom_count;
			// $data['user_id']= $apartment->user_id;
			// dd($apartment);
			// $apartment->save();

			$services = $request->input('services');

			foreach ($services as $service) {
				$apartment->services()->attach($service);
			};

			foreach ($request['apartment_img'] as $img){
		 	 Storage::disk('public')->put('apartment_img', $img);
			 	$image = new Image;
				$image->path = $img;
				$image->apartment_id = $apartment->id;
				$image->save();

		 	}


			return redirect()->route('dashboard');
		}

		public function edit(Request $request) {

			$apartment = Apartment::where('slug', $request->input('slug'))->get()->first();
			//RIGHT OUTERJOIN
			$servizi_non_selezionati = DB::table('services')->select('name', 'id')->whereNOTIn(
			  'id', function ($query) use ($apartment) {
				$query->select('service_id')->from('apartment_service')->where('apartment_id', '=', $apartment->id);
			})->get();

			$action = 'edit';

			$this->collectAddress($apartment);

			$imgData = $this->getMap($apartment->latitude, $apartment->longitude);

			return view('appartamento.edit', compact('servizi_non_selezionati','action'))->withApartment($apartment)->withImage($imgData);
		}

		public function update(Request $request, $id){
			// dd($request->all());
			foreach ($request['apartment_img'] as $img){
		 	 Storage::disk('public')->put('apartment_img', $img);
		 	}

			$validator = $request->validate([
				'title' => 'required',
				'description' => 'required',
				'square_meters' => 'required',
				'room_count' => 'required',
				'bed_count' => 'required',
				'bathroom_count' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'price' => 'required'
			]);

			if( isset($request->new_services))
			{
				$newservices = $request->new_services;
				$apartment = Apartment::find($id);
				foreach ($newservices as $key=>$newservice)
				{
					$service = new Service;
					$service->name = $newservice;
					$service->save();
					$apartment->services()->attach($service->id);
				};
			} else {
				$apartment = Apartment::find($id);
			};

			$apartment->update($validator);


			return redirect()->route('dashboard');
		}

		public function promote($appartamento) {
			//se l'utente non è loggato lo rimando al login
			if (!Auth::check()) {
				return redirect()->route('login');
			}
			$user = Auth::user();
			if (!$user->customer()->exists()) {
				//l'utente si deve accreditare
				return view('customer')->withSlug($appartamento);
			}
			$apartment = Apartment::where('slug', '=', $appartamento)->get()->first();
			//l'utente è già accreditato
			//acquisisco altri appartamenti che vorrebbe poter sponsorizzare dopo la transazione
			$apartments = Apartment::where('id', '<>', $apartment->id)->whereDate('end_promo', '<', now())->orderBy('created_at', 'desc')->take(5)->get();
			return view('payment')->withApartment($apartment)->withWannaPromote($apartments);
		}

		public function stats($slug) {
			if (!Auth::check()) {
				return redirect()->route('login');
			}
			$apartment = Apartment::where('slug', '=', $slug)->get()->first();
			return view('appartamento.stats')->withApartment($apartment);
		}

		public static function test(){
			return function_exists('curl_version');
		}
	}
