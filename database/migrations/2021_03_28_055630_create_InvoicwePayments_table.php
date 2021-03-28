<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicwePaymentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoicwePayments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_descriptions')->nullable();
            $table->string('upload_supportingdocument')->nullable();
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
        Schema::drop('InvoicwePayments');
    }
}
