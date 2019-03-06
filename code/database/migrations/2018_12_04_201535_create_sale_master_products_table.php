<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_master_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_mas_id')->nullable();
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
        Schema::dropIfExists('sale_master_products');
    }
}
