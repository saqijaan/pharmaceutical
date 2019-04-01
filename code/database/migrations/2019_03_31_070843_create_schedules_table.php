<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('employee_id');
            $table->integer('city_id')->nullable();

            $table->text('docters');
            $table->string('day');
            $table->string('detail')->nullable();

            $table->timestamps();

            /**
             * Drop Old Table
             */
            Schema::dropIfExists('schedle_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
