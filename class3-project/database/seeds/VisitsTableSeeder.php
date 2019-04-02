<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class VisitsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker) {
    $apartments = \App\Apartment::get();

    foreach ($apartments as $apartment) {
      for ($i=0; $i < 60; $i++) {
        \App\Visit::create(
          [
            'visited_at' => $faker->dateTimeInInterval('-2 days', '-360 days'),
            'click' => rand(1, 10),
            'apartment_id' => $apartment->id
          ]
        );
      }
    }
  }
}
