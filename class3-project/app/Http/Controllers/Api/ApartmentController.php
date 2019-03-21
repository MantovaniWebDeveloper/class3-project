<?php

	namespace App\Http\Controllers\Api;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;

	class ApartmentController extends Controller {
		function cities() {
			return "ciao";
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
	}
