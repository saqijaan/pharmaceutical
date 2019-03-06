<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->integer('supplier_invoice_no')->nullable();
            $table->string('supplier_name', 99)->nullable();
            $table->string('cargo', 99)->nullable();
            $table->integer('gross_total')->nullable();
            $table->string('discount', 99)->nullable();
            $table->string('cargo_charges', 99)->nullable();
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
        Schema::dropIfExists('purchase_returns');
    }
}
