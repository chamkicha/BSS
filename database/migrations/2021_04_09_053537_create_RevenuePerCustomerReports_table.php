<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRevenuePerCustomerReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RevenuePerCustomerReports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name')->nullable();
            $table->string('customer_no')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('services')->nullable();
            $table->string('excise_dutty')->nullable();
            $table->string('v_a_t')->nullable();
            $table->string('total_wit_vat')->nullable();
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
        Schema::drop('RevenuePerCustomerReports');
    }
}
