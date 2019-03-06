<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributerSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributer_sales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('dis_name', 45)->nullable();
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
        Schema::dropIfExists('distributer_sales_orders');
    }
}
