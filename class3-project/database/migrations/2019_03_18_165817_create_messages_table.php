<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateMessagesTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create(
			  'messages', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('apartment_id');
				$table->string('from');
				$table->text('text');
				$table->timestamps();
				$table->foreign('apartment_id')->references('id')->on('apartments');
			});
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('messages');
		}
	}
