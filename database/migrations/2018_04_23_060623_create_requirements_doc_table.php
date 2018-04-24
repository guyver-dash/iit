<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsDocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements_doc', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('requirement_id')->unsigned()->nullable();
            $table->foreign('requirement_id')->references('id')
                ->on('requirements');
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
        Schema::dropIfExists('requirements_doc');
    }
}
