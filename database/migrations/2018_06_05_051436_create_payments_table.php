<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('balance_id')->unsigned()->nullable();
            $table->foreign('balance_id')->references('id')
                ->on('balances');
            $table->string('receipt_no')->nullable();
            $table->integer('confirm_enrollee_id')->unsigned()->nullable();
            $table->foreign('confirm_enrollee_id')->references('id')
                ->on('confirm_enrolled');
            $table->decimal('amount_given');
            $table->decimal('change');
            $table->decimal('amount_charge');
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
        Schema::dropIfExists('payments');
    }
}
