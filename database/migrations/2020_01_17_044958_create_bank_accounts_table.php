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
            $table->integer( 'building_id' )->unsigned()->nullable(false);
            $table->string('account_number', 30)->unique();
            $table->string('type', 25);
            $table->string('name', 100)->nullable(false)->comment('Dueño de la cuenta');
            $table->string('rif', 20)->nullable(false);
            $table->boolean('pago_movil')->nullable(false)->comment('Si la cuenta acepta o no pago movil');
            $table->timestamps();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings');
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
