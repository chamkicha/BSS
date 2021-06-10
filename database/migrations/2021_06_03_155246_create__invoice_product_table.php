<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_product', function (Blueprint $table) {
            $table->id();
            $table->string('client_no')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_id')->nullable();
            $table->string('vat_amount')->nullable();
            $table->string('amount')->nullable();
            $table->string('service_order_no')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_description')->nullable();
            $table->string('invoice_no')->nullable();
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
        Schema::dropIfExists('invoice_product');
    }
}
