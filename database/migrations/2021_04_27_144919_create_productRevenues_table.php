<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductRevenuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productRevenues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->nullable();
            $table->string('price')->nullable();
            $table->string('vat')->nullable();
            $table->string('excise_dutty')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('product_revenue')->nullable();
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
        Schema::drop('productRevenues');
    }
}
