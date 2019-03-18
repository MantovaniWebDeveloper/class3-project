<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateApartmentsTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create(
			  'apartments', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('user_id');
				$table->string('title',100);
				$table->string('title_slug',110)->unique();
				$table->text('description');
				$table->tinyInteger('room_count');
				$table->tinyInteger('bed_count');
				$table->tinyInteger('bathroom_count');
				$table->smallInteger('square_meters');
				$table->float('latitude',8,5);
				$table->float('longitude',8,5);
				$table->tinyInteger('sale')->default(0);
				$table->tinyInteger('is_showed')->default(1);
				$table->dateTime('end_promo')->nullable();
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
			});
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('apartments');
		}
	}
