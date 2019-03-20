<?php
	
	namespace App\Http\Controllers;
	
	use App\Apartment;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
	use Illuminate\Support\Facades\DB;
	
	class ApartmentController extends Controller {
		
		/*
		 * Ritorna la homepage con un appartamento in offerta e n appartamenti in evidenza
		 */
		function index() {
			$utc = Carbon::now('Europe/Rome');
			try {
				$saleApartment = Apartment::where('sale', '>', 0)->inRandomOrder()->first();
				$promoApartments = Apartment::where('end_promo', '>', $utc)->orderBy('end_promo', 'asc')->take(5)->get();
				return view('index')->withSaleApartment($saleApartment)->withPromoApartments($promoApartments);
			} catch (\Exception $e) {
				return abort(500);
			}
		}
		
		/*
		 * Ritorna la pagina della ricerca avanzata con eventualmente i ri
		 */
		function simpleSearch(Request $request) {
			if (!$request->has('lat') || !$request->has('lng') || !$request->has('query') || !$request->has('bed_count')) {
				abort(404);
			}
			$radius = 20;
			$pagination = 10;
			try {
				$lat = $request->input('lat');
				$lng = $request->input('lng');
				$bedCount = $request->input('bed_count');
				$data = Apartment::findInRange($radius, $lat, $lng)->where('bed_count', '>=', $bedCount)->paginate($pagination);
				return view('result')->withApartments($data);
			} catch (\Exception $e) {
				return abort(500);
			}
		}
		
		function showAdvancedSearch() {
			$utc = Carbon::now('Europe/Rome');
			try {
				$promoApartments = Apartment::where('end_promo', '>', $utc)->orderBy('end_promo', 'asc')->take(5)->get();
				return view('index')->withPromoApartments($promoApartments);
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
		}
		
		function advancedSearch(Request $request) {
			return "TODO";
		}
		
	}
