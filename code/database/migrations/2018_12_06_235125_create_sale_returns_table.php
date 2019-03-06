<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->integer('cus_invoice_no')->nullable();
            $table->string('cus_name', 99)->nullable();
            $table->integer('gross_total')->nullable();
            $table->string('discount', 99)->nullable();
            $table->integer('net_total')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('bal_amount')->nullable();
            $table->text('detail')->nullable();
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
        Schema::dropIfExists('sale_returns');
    }
}
