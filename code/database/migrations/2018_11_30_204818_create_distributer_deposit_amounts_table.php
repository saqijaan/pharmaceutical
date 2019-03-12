<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributerDepositAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributer_deposit_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dis_id');
            $table->string('dis_name', 30)->nullable();
            $table->string('slip_name', 30)->nullable();
            $table->string('date', 30)->nullable();
            $table->string('bank_name', 30)->nullable();
            $table->string('amount', 30)->nullable();
            $table->boolean('approved')->default(0);
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
        Schema::dropIfExists('distributer_deposit_amounts');
    }
}
