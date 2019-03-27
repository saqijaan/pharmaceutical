<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSchedleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedle_models', function (Blueprint $table) {

            $table->boolean('visited')->default(false)->after('y');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedle_models', function (Blueprint $table) {
            
            $table->dropColumn('visited');

        });
    }
}
