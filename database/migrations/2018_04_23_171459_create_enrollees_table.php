<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_type_id')->unsigned()->nullable();
            $table->foreign('student_type_id')->references('id')
                ->on('student_type');
            $table->integer('lrn')->unsigned()->nullable();
            $table->string('idno')->nullable();
            $table->bigInteger('admissionNo');
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')
                ->on('courses');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->string('age');
            $table->date('birthday')->nullable();
            $table->string('birth_place');
            $table->integer('sex');
            $table->integer('civil_id')->unsigned()->nullable();
            $table->foreign('civil_id')->references('id')
                ->on('civil_status');
            $table->string('spouse_lastname')->nullable();
            $table->string('spouse_firstname')->nullable();
            $table->string('spouse_middlename')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->string('religion');
            $table->string('citizenship');
            $table->string('present_address');
            $table->integer('present_province_id');
            $table->integer('present_city_id');
            $table->integer('present_zipcode');
            $table->string('permanent_address');
            $table->integer('permanent_province_id');
            $table->integer('permanent_city_id');
             $table->integer('permanent_zipcode');
            $table->integer('educ_at_id')->unsigned()->nullable();
            $table->foreign('educ_at_id')->references('id')
                ->on('educational_attainments');

            $table->string('father_firstname');
            $table->string('father_lastname');
            $table->string('father_middlename');
            $table->string('father_occupation');
            $table->string('father_contact_number')->nullable();
            $table->string('father_address');
            $table->integer('father_province_id');
            $table->integer('father_city_id');
             $table->integer('father_zipcode');

            $table->string('mother_firstname');
            $table->string('mother_lastname');
            $table->string('mother_middlename');
            $table->string('mother_occupation');
            $table->string('mother_contact_number')->nullable();
            $table->string('mother_address');
            $table->integer('mother_province_id');
            $table->integer('mother_city_id');
            $table->integer('mother_zipcode');

            $table->string('name_of_school');
            $table->string('school_address');
            $table->integer('school_province_id');
            $table->integer('school_city_id');
            $table->integer('school_zipcode');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('enrollees');
    }
}
