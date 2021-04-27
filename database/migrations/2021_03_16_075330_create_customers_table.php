<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customername')->nullable();
            $table->string('t_i_n_number')->nullable();
            $table->string('v_a_t_registration_number')->nullable();
            $table->string('business_license_number')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('position_held')->nullable();
            $table->string('contact_telephone')->nullable();
            $table->string('office_telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('fax')->nullable();
            $table->string('customer_type')->nullable();
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
        Schema::drop('customers');
    }
}
