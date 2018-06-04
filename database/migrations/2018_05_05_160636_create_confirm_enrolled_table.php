<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_enrolled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('student_type_id')->unsigned()->nullable();
            $table->foreign('student_type_id')->references('id')
                ->on('student_type');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')
                ->on('courses');
            $table->integer('school_year_id')->unsigned()->nullable();
            $table->foreign('school_year_id')->references('id')
                ->on('school_years');
             $table->integer('year_level_id')->unsigned()->nullable();
            $table->foreign('year_level_id')->references('id')
                ->on('year_levels');
            $table->integer('semester_id')->unsigned()->nullable();
            $table->foreign('semester_id')->references('id')
                ->on('semesters');
            $table->integer('schedule_id')->nullable();
            $table->boolean('status')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
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
        Schema::dropIfExists('confirm_enrolled');
    }
}
