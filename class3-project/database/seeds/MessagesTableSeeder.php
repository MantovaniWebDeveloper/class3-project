<?php
	
	use Illuminate\Database\Seeder;
	
	class MessagesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$apartments = \App\Apartment::get();
			foreach ($apartments as $apartment) {
				\App\Message::create(
				  [
					'from' => 'maccio@capatonda.it',
					'body' => 'ma tu ce li hai i soldi??',
					'apartment_id' => $apartment->id
				  ]
				);
			}
		}
	}
