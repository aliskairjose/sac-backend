<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_accounts', function(Blueprint $table){
            $table->string('name', 100)->nullable(false)->comment('Dueño de la cuenta');
            $table->string('rif', 20)->nullable(false);
            $table->boolean('pago_movil')->nullable(false)->comment('Si la cuenta acepta o no pago movil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
