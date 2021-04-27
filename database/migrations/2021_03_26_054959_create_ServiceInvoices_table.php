<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceInvoicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServiceInvoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('invoice_created_date')->nullable();
            $table->date('invoice_due_date')->nullable();
            $table->string('service_order_no')->nullable();
            $table->string('due_balance')->nullable();
            $table->string('current_charges')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('service_name')->nullable();
            $table->string('cusromer_name')->nullable();
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
        Schema::drop('ServiceInvoices');
    }
}
