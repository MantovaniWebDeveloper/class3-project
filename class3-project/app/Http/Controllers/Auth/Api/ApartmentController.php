<?php

	namespace App\Http\Controllers\Auth\Api;

	use App\Apartment;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Validation\Rule;
	use App\Traits\ReverseGeo;

	class ApartmentController extends Controller {

		use ReverseGeo;

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
				$result = Apartment::where('slug', $data['slug'])
				  ->update(['is_showed' => $data['visible']]);
				return $result;
			} catch (\Exception $e) {
				return false;
			}
		}

		function delete(Request $request) {
			try {
				$userId = \Auth::id();
				//validazione
				$validator = \Validator::make(
				  $request->all(), [
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
			} catch (\Exception $e) {
				return response()->json('Errore con i dati inviati', 401);
			}
			DB::beginTransaction();
			try {
				$data = $validator->getData();
				$apartment = Apartment::where('slug', $data['slug'])->first();
				$apartment->services()->detach();
				$result = $apartment->delete();
				DB::commit();
				return ['response' => $result];
			} catch (\Exception $e) {
				DB::rollBack();
				return response()->json('Errore nel server', 500);
			}
		}

		function getMapFromCoordinates(Request $request){
			if (!$request->has('lat') || !$request->has('long') ) {
					return response()->json('Dati mancanti', 419);
			}
			return getMap($request->input('lat'), $request->input('long'));
		}

	}
