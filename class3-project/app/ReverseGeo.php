<?php
	namespace App\Traits;
	
	use GuzzleHttp\Client;
	
	trait ReverseGeo {
		private $client;
		private $api;
		
		public function __construct() {
			$this->api = config('app.tomtom_api');
			$this->client = new Client(
			  [
				'base_uri' => 'https://api.tomtom.com'
			  ]);
		}
		
		public function collectAddresses(&$collection) {
			//recupero indirizzi
			foreach ($collection as $item) {
				$reverseAddress = $this->getAddress($item->latitude, $item->longitude);
				$item->address = $reverseAddress;
			}
		}
		
		private function getAddress($latitude, $longitude) {
			$useFake = false;
			$address = [
			  'streetName' => '',
			  'municipality' => '',
			  'postal_code' => '',
			  'province' => ''
			];
			if (is_null($this->api) || $useFake) {
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
		
		public function collectAddress(&$apartment) {
			$reverseAddress = $this->getAddress($apartment->latitude, $apartment->longitude);
			$apartment->address = $reverseAddress;
		}
		
		public function getMap($lat, $lon) {
			$center = "$lon,$lat";
			$uri = '/map/1/staticimage';
			try {
				$response = $this->client->request(
				  'GET',
				  $uri, [
					'query' => [
					  'layer' => 'basic',
					  'style' => 'main',
					  'format' => 'png',
					  'zoom' => 16,
					  'center' => $center,
					  'width' => 512,
					  'height' => 512,
					  'view' => 'Unified',
					  'key' => $this->api
					],
					'headers' => [
					  'Accept' => '*/*'
					]
				  ]);
			} catch (\Exception $e) {
				return null;
			}
			$data = $response->getBody()->getContents();
			return base64_encode($data);
		}
	}