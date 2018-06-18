<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceConfirmEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_confirm_enrolled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('confirm_enrolled_id')->unsigned()->nullable();
            $table->foreign('confirm_enrolled_id')->references('id')
                ->on('confirm_enrolled');
            $table->integer('balance_id')->unsigned()->nullable();
            $table->foreign('balance_id')->references('id')
                ->on('balances');
            $table->integer('discount_amount')->nullable();
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
        Schema::dropIfExists('balance_confirm_enrolled');
    }
}
