<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date', 30)->nullable();
            $table->string('acnt_nme', 250)->nullable();
            $table->string('rcv_csh', 250)->nullable();
            $table->string('acnt_nbr', 250)->nullable();
            $table->string('amount', 250)->nullable();
            $table->string('trans_id', 250)->nullable();
            $table->string('detail', 500)->nullable();
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
        Schema::dropIfExists('cash_receipts');
    }
}
