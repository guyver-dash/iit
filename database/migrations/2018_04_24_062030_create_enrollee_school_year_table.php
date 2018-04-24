<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleeSchoolYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_school_year', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('school_year_id')->unsigned()->nullable();
            $table->foreign('school_year_id')->references('id')
                ->on('school_years');
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
        Schema::dropIfExists('enrollee_school_year');
    }
}
