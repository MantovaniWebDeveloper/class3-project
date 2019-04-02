<?php

	use Illuminate\Database\Seeder;
	use Faker\Generator as Faker;

	class MessagesTableSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run(Faker $faker) {
			$apartments = \App\Apartment::get();

			foreach ($apartments as $apartment) {
				for ($i=0; $i < 20; $i++) {
					\App\Message::create(
						[
							'from' => $faker->email,
							'body' => $faker->text(50),
							'apartment_id' => $apartment->id,
							'created_at' => $faker->dateTimeInInterval('-2 days', '-360 days')
						]
					);
				}
			}
		}
	}
