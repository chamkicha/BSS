<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentAndDuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentAndDues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance')->nullable();
            $table->string('customer_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('PaymentAndDues');
    }
}
