<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sr')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('date')->nullable();
            $table->string('detail')->nullable();
            $table->string('dr')->nullable();
            $table->string('cr')->nullable();
            $table->string('voucher_type')->nullable();
            $table->string('check_no')->nullable();
            $table->string('clearance_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('sale_invoice')->nullable();
            $table->string('purchase_invoice')->nullable();
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
        Schema::dropIfExists('transaction_tables');
    }
}
