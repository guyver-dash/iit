<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmEnrolledPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_enrolled_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('confirm_enrolled_id')->unsigned()->nullable();
            $table->foreign('confirm_enrolled_id')->references('id')
                ->on('confirm_enrolled');
            $table->integer('payment_id')->unsigned()->nullable();
            $table->foreign('payment_id')->references('id')
                ->on('payments');
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
        Schema::dropIfExists('confirm_enrolled_payment');
    }
}
