<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleeScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('schedule_id')->unsigned()->nullable();
            $table->foreign('schedule_id')->references('id')
                ->on('schedules');
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
        Schema::dropIfExists('enrollee_schedule');
    }
}
