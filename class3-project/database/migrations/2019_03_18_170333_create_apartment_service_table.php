<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateApartmentServiceTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create(
			  'apartment_service', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('apartment_id');
				$table->unsignedInteger('service_id');
				$table->foreign('apartment_id')->references('id')->on('apartments');
				$table->foreign('service_id')->references('id')->on('services');
				$table->timestamps();
			});
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('apartment_service');
		}
	}
