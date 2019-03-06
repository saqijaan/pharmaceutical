<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedle_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('doctor', 70)->nullable();
            $table->string('address', 70)->nullable();
            $table->string('detail', 70)->nullable();
            $table->string('gift', 70)->nullable();
            $table->string('sample', 70)->nullable();
            $table->string('brochure', 70)->nullable();
            $table->string('city', 70)->nullable();
            $table->string('x', 100)->nullable();
            $table->string('y', 100)->nullable();
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
        Schema::dropIfExists('schedle_models');
    }
}
