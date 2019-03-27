<?php
	
	namespace App\Http\Controllers\Auth\Api;
	
	use App\Apartment;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Validation\Rule;
	
	class ApartmentController extends Controller {
		
		public function __construct() {
			$this->middleware('auth:api');
		}
		
		function setVisibility(Request $request) {
			try {
				$userId = \Auth::id();
				//validazione
				$validator = \Validator::make(
				  $request->all(), [
				  'visible' => 'required|boolean',
				  'slug' => [
					'required', 'string',
					Rule::exists('apartments')->where(
					  function ($query) use ($userId) {
						  $query->where('user_id', $userId);
					  }),
				  ]
				]);
				if ($validator->fails()) {
					return response()->json('Errore con i dati inviati', 401);
				}
				$data = $validator->getData();
				sleep(1);
				$result = Apartment::where('user_id', $userId)
				  ->where('slug', $data['slug'])
				  ->update(['is_showed' => $data['visible']]);
				return $result;
			} catch (\Exception $e) {
				return false;
			}
		}
	}
