<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleeYearLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_year_level', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('year_level_id')->unsigned()->nullable();
            $table->foreign('year_level_id')->references('id')
                ->on('year_levels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollee_year_level');
    }
}
