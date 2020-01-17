<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false);
            $table->string('email', 70)->unique()->nullable(false);
            $table->string('state', 30)->nullable();
            $table->string('providence', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('floors', 2)->nullable();
            $table->string('apartments', 10)->nullable();
            $table->string('rif', 15)->nullable();
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
        Schema::dropIfExists('residencies');
    }
}
