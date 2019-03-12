<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributerOrderBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributer_order_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('po_id')->nullable();
            $table->string('dist_id', 11)->nullable();
            $table->string('dist_name',100)->nullable();
            $table->boolean('delivered')->default(0);
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
        Schema::dropIfExists('distributer_order_books');
    }
}
