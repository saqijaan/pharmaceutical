<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date', 30)->nullable();
            $table->string('acnt_nme', 250)->nullable();
            $table->string('acnt_nbr', 250)->nullable();
            $table->string('amount', 250)->nullable();
            $table->string('detail', 500)->nullable();
            $table->string('bnk_nme', 150)->nullable();
            $table->string('chqe_no', 150)->nullable();
            $table->string('clrance_date', 150)->nullable();
            $table->string('bnk_rfrence', 150)->nullable();
            $table->string('rmndr_dte', 150)->nullable();
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
        Schema::dropIfExists('bank_payments');
    }
}
