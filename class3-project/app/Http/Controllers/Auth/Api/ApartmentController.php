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

		public function setVisibility(Request $request) {
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

		public function delete(Request $request) {
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

		public function getMapFromCoordinates(Request $request){
			if (!$request->has('lat') || !$request->has('long') ) {
					return response()->json('Dati mancanti', 419);
			}
			return $this->getMap($request->input('lat'), $request->input('long'));
		}

		public function getStats(Request $request) {
			if (!$request->has('slug') || !$request->has('group_by')) {
				return response()->json('Dati mancanti', 419);
			}
			$date = \Carbon\Carbon::now();
			$date->subYear();
			$date->addMonth();
			$messages_data = [];
			$visits_data = [];
			$startDate = \Carbon\Carbon::now();
			$startDate->subYear();
			$startDate->addMonth();
			$startDate->day = 1;
			for ($i = 0; $i < 12; $i++) {
				$messages_data[$date->month . '-' . $date->year] = 0;
				$visits_data[$date->month . '-' . $date->year] = 0;
				$date->addMonth();
			}
			$slug = $request->input('slug');
			$messagesStats = DB::table('messages')->select(DB::raw('count(messages.id) as "somma"'), DB::raw("CONCAT_WS('-',MONTH(messages.created_at),YEAR(messages.created_at)) as monthyear"))
			  ->join('apartments', 'apartments.id', '=', 'messages.apartment_id')
			  ->where('apartments.slug', '=', $slug)
			  ->groupby('monthyear')
			  ->where('messages.created_at', '>=', $startDate)
			  ->get();
			$clickStats = DB::table('visits')->select(DB::raw('sum(visits.click) as "somma"'), DB::raw("CONCAT_WS('-',MONTH(visits.visited_at),YEAR(visits.visited_at)) as monthyear"))
			  ->join('apartments', 'apartments.id', '=', 'visits.apartment_id')
			  ->where('apartments.slug', '=', $slug)
			  ->groupby('monthyear')
			  ->where('visits.visited_at', '>=', $startDate)
			  ->get();
			foreach ($messagesStats as $messageStat) {
				$messages_data[$messageStat->monthyear] = $messageStat->somma;
			}
			foreach ($clickStats as $clickStat) {
				$visits_data[$clickStat->monthyear] = $clickStat->somma;
			}
			return response()->json(['messages' => $messages_data, 'visits' => $visits_data], 200);
		}
	}
