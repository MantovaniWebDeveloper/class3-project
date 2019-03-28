<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('customerId')->unique();
			$table->string('firstName', 100);
			$table->string('lastName', 100);
			$table->string('streetAddress');
			$table->string('extendedAddress')->nullable();
			$table->string('locality');
			$table->integer('postalCode');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
