<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToDoctorRegis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_regis', function (Blueprint $table) {

            $table->double('x')->nullable()->after('name');
            $table->double('y')->nullable()->after('x');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_regis', function (Blueprint $table) {

            $table->dropColumn('x');
            $table->dropColumn('y');

        });
    }
}
