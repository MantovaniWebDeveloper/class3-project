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

		public function getAddress($latitude, $longitude) {
			$address = [
			  'streetName' => '',
			  'municipality' => '',
			  'postal_code' => '',
			  'province' => ''
			];
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
  ?>
