<?php
	
	use Illuminate\Database\Seeder;
	
	class ServicesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$services = ['Piscina', 'Fronte mare', 'Lavanderia', 'Canile', 'WiFi', 'Palestra', 'Tornio', 'Specchio a soffitto', 'Materasso ad acqua', 'Frustini in pelle'];
			foreach ($services as $service) {
				\App\Service::create(['name' => $service]);
			}
		}
	}
