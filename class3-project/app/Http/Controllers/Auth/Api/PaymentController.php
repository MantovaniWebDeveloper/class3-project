<?php
	
	namespace App\Http\Controllers\Auth\Api;
	
	use App\Apartment;
	use Braintree_Gateway;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	
	class PaymentController extends Controller {
		
		private $gateway;
		
		public function __construct() {
			$this->gateway = new Braintree_Gateway(
			  config('app.braintree'));
		}
		
		public function getCustomerToken() {
			$user = \Auth::user();
			$clientToken = $this->gateway->clientToken()->generate(
			  [
				"customerId" => $user->customer()->first()->customerId
			  ]);
			return ['token' => $clientToken];
		}
		
		public function checkout(Request $request) {
			$validatedData = $request->validate(
			  [
				'promotion_type' => 'required|integer|in:0,1,2',
				'paymentMethodNonce' => 'required',
				'slug' => 'required'
			  ]);
			switch ($validatedData['promotion_type']) {
				case 0:
					$amount = 2.99;
					$hours = 24;
					break;
				case 1:
					$amount = 5.99;
					$hours = 72;
					break;
				default:
					$amount = 9.99;
					$hours = 144;
			}
			$result = $this->gateway->transaction()->sale(
			  [
				'amount' => $amount,
				'paymentMethodNonce' => $validatedData['paymentMethodNonce'],
				'options' => [
				  'submitForSettlement' => True
				]
			  ]);
			if ($result->success) {
				return $this->setEndPromo($hours, $validatedData['slug']);
			}
			return response()->json('Transazione non autorizzata', 401);
		}
		
		private function setEndPromo($hours, $slug) {
			$apartment = Apartment::where('slug', $slug)->get()->first();
			if (is_null($apartment->end_promo)) {
				//non ci sono promozioni impostate
				$apartment->end_promo = Carbon::now()->addHours($hours);
				$apartment->save();
				return response()->json($this->getJsonResponse(false, $apartment->end_promo),200);
			} else {
				$endPromo = Carbon::parse($apartment->end_promo);
				if ($endPromo->greaterThan(Carbon::now())) {
					//c'è già una promo in corso per l'appartamento
					$endPromo->addHours($hours);
					$apartment->end_promo =$endPromo;
					$apartment->save();
					return response()->json($this->getJsonResponse(true, $apartment->end_promo),200);
				} else {
					//la promo dell'appartamento è scaduta
					$apartment->end_promo = Carbon::now()->addHours($hours);
					$apartment->save();
					return response()->json($this->getJsonResponse(false, $apartment->end_promo),200);
				}
			}
		}
		
		private function getJsonResponse($running_promo, $end_promo) {
			return [
			  'running_promo' => $running_promo,
			  'end_promo' => $end_promo
			];
		}
	}
