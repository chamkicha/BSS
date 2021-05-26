<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAginganalysisreportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aginganalysisreports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->nullable();
            $table->string('customer_no')->nullable();
            $table->string('total')->nullable();
            $table->string('0-30_days')->nullable();
            $table->string('31-60_days')->nullable();
            $table->string('61-90_days')->nullable();
            $table->string('91-120_days')->nullable();
            $table->string('121-180_days')->nullable();
            $table->string('181+_days')->nullable();
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
        Schema::drop('aginganalysisreports');
    }
}
