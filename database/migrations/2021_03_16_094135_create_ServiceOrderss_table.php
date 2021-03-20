<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceOrderssTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServiceOrderss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_i_d')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('service_status')->nullable();
            $table->string('price')->nullable();
            $table->date('service_starting_date')->nullable();
            $table->date('service_ending_date')->nullable();
            $table->string('service_descriptions')->nullable();
            $table->string('service_lists')->nullable();
            $table->string('next_handler')->nullable();
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
        Schema::drop('ServiceOrderss');
    }
}
