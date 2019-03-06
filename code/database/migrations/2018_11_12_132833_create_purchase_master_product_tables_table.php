<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseMasterProductTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_master_product_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pur_mas_id')->nullable();
            $table->string('item')->nullable();
            $table->string('quantity')->nullable();
            $table->string('cost_price')->nullable();
            $table->string('per_item_dis')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('purchase_master_product_tables');
    }
}
