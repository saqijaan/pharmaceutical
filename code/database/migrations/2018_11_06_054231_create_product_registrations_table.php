<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150)->nullable();
            $table->string('cost_price',150)->nullable();
            $table->string('slae_price',150)->nullable();
            $table->string('reorder_level',150)->nullable();
            $table->string('unit',150)->nullable();
            $table->string('box',150)->nullable();
            $table->string('barcode',150)->nullable();
            $table->string('vait',150)->nullable();
            $table->string('detail',150)->nullable();
            $table->string('company_discount',150)->nullable();
            $table->string('holesale_price',150)->nullable();
            $table->string('image')->nullable();
            $table->integer('cate_id')->nullable();
            $table->integer('brand_id')->nullable();
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
        Schema::dropIfExists('product_registrations');
    }
}
