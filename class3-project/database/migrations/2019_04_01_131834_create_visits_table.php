<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create(
		  'visits', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('apartment_id');
			$table->date('visited_at');
			$table->integer('click')->default(1);
			$table->timestamps();
			$table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
