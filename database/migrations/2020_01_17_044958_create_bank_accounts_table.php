<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bank_id')->index('bank_id')->unsigned();
            $table->integer('residency_id')->index('residency_id')->unsigned();
            $table->string('account_number', 30)->unique();
            $table->string('type', 25);
            $table->timestamps();

           $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
           $table->foreign('residency_id')->references('id')->on('residences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
