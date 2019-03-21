<?php
	
	use Illuminate\Database\Seeder;
	
	class ImagesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {
			$images = ['image1.png', 'image2.png', 'image3.png', 'image4.png', 'image5.png'];
			$apartments = \App\Apartment::get();
			foreach ($apartments as $apartment) {
				shuffle($images);
				$imagesToAttach = rand(1, count($images));
				for ($i = 0; $i < $imagesToAttach; $i++) {
					\App\Image::create(
					  [
						'apartment_id' => $apartment->id,
						'path' => $images[$i]
					  ]
					);
				}
			}
		}
	}
