<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditNotesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CreditNotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('credit_note_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('reason_for_adjustment')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status')->nullable();
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
        Schema::drop('CreditNotes');
    }
}
