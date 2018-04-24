<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrolleeSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollee_semester', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enrollee_id')->unsigned()->nullable();
            $table->foreign('enrollee_id')->references('id')
                ->on('enrollees');
            $table->integer('educational_att_id')->unsigned()->nullable();
            $table->foreign('educational_att_id')->references('id')
                ->on('educational_attainments');
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
        Schema::dropIfExists('enrollee_semester');
    }
}
