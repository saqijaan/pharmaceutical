<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributerOrderBookItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributer_order_book_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dis_odr_book_id', 11)->nullable();
            $table->string('item', 45)->nullable();
            $table->string('quantity', 11)->nullable();
            $table->string('total', 11)->nullable();
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
        Schema::dropIfExists('distributer_order_book_items');
    }
}
