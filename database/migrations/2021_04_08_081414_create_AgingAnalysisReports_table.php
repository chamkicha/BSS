<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgingAnalysisReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AgingAnalysisReports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->nullable();
            $table->string('customer_no')->nullable();
            $table->string('30_days')->nullable();
            $table->string('60_days')->nullable();
            $table->string('90_days')->nullable();
            $table->string('120_days')->nullable();
            $table->string('150_days')->nullable();
            $table->string('180_days')->nullable();
            $table->string('morethan180_days')->nullable();
            $table->string('total')->nullable();
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
        Schema::drop('AgingAnalysisReports');
    }
}
