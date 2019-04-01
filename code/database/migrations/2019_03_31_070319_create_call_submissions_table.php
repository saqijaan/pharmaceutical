<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_submissions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('employe_id');
            $table->integer('docter_id');
            
            $table->string('day');
            $table->double('x');
            $table->double('y');
            $table->text('detail');
            $table->boolean('product');
            $table->boolean('gift');
            $table->boolean('sample');
            $table->boolean('visited');

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
        Schema::dropIfExists('call_submissions');
    }
}
