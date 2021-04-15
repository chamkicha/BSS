<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNidcConfigsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nidcConfigs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tin_num')->nullable();
            $table->string('vfd')->nullable();
            $table->string('cert_path')->nullable();
            $table->string('cert_password')->nullable();
            $table->string('cert_serial')->nullable();
            $table->string('datetime')->nullable();
            $table->string('regid')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('recptcode')->nullable();
            $table->string('routekey')->nullable();
            $table->string('access_token')->nullable();
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
        Schema::drop('nidcConfigs');
    }
}
