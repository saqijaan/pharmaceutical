<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributerOrderBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributer_order_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('dis_name', 45)->nullable();
            $table->string('dis_odr_item',11)->nullable();
            $table->string('gross_total', 11)->nullable();
            $table->string('discount', 11)->nullable();
            $table->string('net_total', 11)->nullable();
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
        Schema::dropIfExists('distributer_order_books');
    }
}
