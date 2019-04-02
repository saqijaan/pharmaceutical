<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildsToDailySummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_summaries', function (Blueprint $table) {
            
            $table->integer('employee_id');
            $table->string('work_type')->default('local');
            $table->double('dailyfixedAmount')->nullable();
            $table->double('total_km')->nullable();
            $table->boolean('night_stay')->default(false);
            $table->double('night_stay_allownce')->nullable();
            $table->text('night_stay_description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_summaries', function (Blueprint $table) {
            //
        });
    }
}
