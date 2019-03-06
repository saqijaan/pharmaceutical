<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalVouchersEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_vouchers_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jrnl_vchrs_entrs', 100)->nullable();
            $table->string('acnt_nme', 100)->nullable();
            $table->string('bnk_nme', 100)->nullable();
            $table->string('chqe_no', 100)->nullable();
            $table->string('bnk_rfrence', 100)->nullable();
            $table->string('dr', 100)->nullable();
            $table->string('cr', 100)->nullable();
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
        Schema::dropIfExists('journal_vouchers_entries');
    }
}
