<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceBillingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServiceBillings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_no')->nullable();
            $table->string('service_order_no')->nullable();
            $table->string('billing_date')->nullable();
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
        Schema::drop('ServiceBillings');
    }
}
