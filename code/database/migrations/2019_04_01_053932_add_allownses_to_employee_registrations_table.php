<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllownsesToEmployeeRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_registrations', function (Blueprint $table) {

            $table->double('daily_fixed_amount');
            $table->double('per_km_charges');
            $table->double('night_stay_allowns');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_registrations', function (Blueprint $table) {
            
            $table->dropColumn('daily_fixed_amount');
            $table->dropColumn('per_km_charges');
            $table->dropColumn('night_stay_allowns');

        });
    }
}
