<?php
	namespace App\Traits;

	use GuzzleHttp\Client;

	trait ReverseGeo {
		private $client;

		public function __construct() {

			$this->client = new Client(
			  [
				'base_uri' => 'https://api.tomtom.com'
			  ]);
		}

		public function collectAddress(&$collection) {
			//recupero indirizzi
			foreach ($collection as $item) {
				$reverseAddress = $this->getAddress($item->latitude, $item->longitude);
				$item->address = $reverseAddress;
			}
		}

		private function getAddress($latitude, $longitude) {
			$api = config('app.tomtom_api');
			$useFake = true;
			$address = [
			  'streetName' => '',
			  'municipality' => '',
			  'postal_code' => '',
			  'province' => ''
			];
			if (is_null($api) || $useFake) {
				$address['streetName'] = 'via Roma 125';
				$address['municipality'] = 'Gubbio';
				$address['postal_code'] = '68974';
				$address['province'] = 'Gubbio';
				return $address;
			}
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
					$address['streetName'] = $decodedJson['addresses'][0]['address']['streetName'];
				}
				if (array_key_exists('municipality', $decodedJson['addresses'][0]['address'])) {
					$address['municipality'] = $decodedJson['addresses'][0]['address']['municipality'];
				}
				if (array_key_exists('postalCode', $decodedJson['addresses'][0]['address'])) {
					$address['postal_code'] = $decodedJson['addresses'][0]['address']['postalCode'];
				}
				if (array_key_exists('countrySecondarySubdivision', $decodedJson['addresses'][0]['address'])) {
					$address['province'] = $decodedJson['addresses'][0]['address']['countrySecondarySubdivision'];
				}
				return $address;
			} catch (\Exception $e) {
				return $address;
			}
		}
	}
