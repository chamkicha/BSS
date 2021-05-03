<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductServiceOrderListsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ProductServiceOrderLists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->nullable();
            $table->string('product_no')->nullable();
            $table->string('description')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('order_i_d')->nullable();
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
        Schema::drop('ProductServiceOrderLists');
    }
}
