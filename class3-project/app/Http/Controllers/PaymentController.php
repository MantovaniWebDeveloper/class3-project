<?php
	
	namespace App\Http\Controllers;
	
	use App\Customer;
	use Braintree_Gateway;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	class PaymentController extends Controller {
		
		private $gateway;
		
		public function __construct() {
			$this->gateway = new Braintree_Gateway(
			  config('app.braintree'));
		}
		
		public function createCustomer(Request $request, $appartamento) {
			if (!Auth::check()) {
				return redirect()->route('login');
			}
			$validatedData = $request->validate(
			  [
				'firstName' => 'required|max:100',
				'lastName' => 'required|max:100',
				'streetAddress' => 'required|max:255',
				'extendedAddress' => 'nullable|max:255',
				'locality' => 'required|max:255',
				'postalCode' => 'required|integer'
			  ]);
			$userId = Auth::id();
			$newCustomer = $this->gateway->customer()->create();
			$newCustomerId = $newCustomer->customer->id;
			$validatedData['customerId'] = $newCustomerId;
			$result = $this->gateway->address()->create($validatedData);
			if ($result->success) {
				//memorizzo in db
				$data = $request->all();
				$data['customerId'] = $newCustomerId;
				$data['user_id'] = $userId;
				Customer::create($data);
				return redirect()->route('sponsorizza', $appartamento);
			} else {
				//errore nella creazione del customer
				return redirect()->back()->withErrorMessage('Errore durante la creazione ');
			}
		}
	}
