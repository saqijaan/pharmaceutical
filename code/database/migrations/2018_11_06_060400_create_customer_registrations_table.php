<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150)->nullable();
            $table->string('nic')->nullable();
            $table->string('email',150)->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('image')->nullable();
            $table->string('username_auto')->nullable();
            $table->string('password_auto')->nullable();
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
        Schema::dropIfExists('customer_registrations');
    }
}
