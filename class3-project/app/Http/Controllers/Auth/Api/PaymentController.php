<?php
	
	namespace App\Http\Controllers\Auth\Api;
	
	use App\Apartment;
	use Braintree_Gateway;
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
					break;
				case 1:
					$amount = 5.99;
					break;
				default:
					$amount = 9.99;
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
				$this->promoteApartment($validatedData['slug']);
				return response()->json('Transazione autorizzata', 200);
			}
			return response()->json('Transazione non autorizzata', 401);
		}
		
		private function promoteApartment($slug) {
			$apartment = Apartment::where('slug', $slug)->get()->first();
			$servizi_non_selezionati = DB::table('services')->select('name', 'id')->whereNOTIn(
			  'id', function ($query) use($apartment) {
				$query->select('service_id')->from('apartment_service')->where('apartment_id', '=', $apartment->id);
			})->get();
			
		}
		
	}
