<?php
	
	use Illuminate\Database\Seeder;
	
	class ApartmentsServicesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$services = \App\Service::get();
			$maxServicesForApartment = count($services);
			$apartments = \App\Apartment::get();
			foreach ($apartments as $apartment) {
				for ($i = 0; $i < rand(1, $maxServicesForApartment); $i++) {
					$apartment->services()->attach($services->get($i));
				}
			}
		}
	}
