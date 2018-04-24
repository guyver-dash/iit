<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleeCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')
                ->on('courses');
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
        Schema::dropIfExists('enrollee_course');
    }
}
