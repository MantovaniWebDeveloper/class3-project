<?php
	
	use Illuminate\Database\Seeder;
	use Faker\Generator as Faker;
	
	class UsersTableSeeder extends Seeder {
		
		public function run(Faker $faker) {
			$usersToGenerate = 10;
			for ($i = 0; $i < $usersToGenerate; $i++) {
				\App\User::create(
				  [
					'email' => $faker->unique()->email,
					'password' => 'boolean',
					'first_name' => $faker->firstName,
					'last_name' => $faker->lastName,
					'date_of_birth' => $faker->dateTime,
				  ]);
			}
		}
	}
