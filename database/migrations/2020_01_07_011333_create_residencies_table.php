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
            $table->string('email', 70)->nullable(false);
            $table->string('state', 30)->nullable();
            $table->string('providence', 30)->nullable();
            $table->longText('address')->nullable();
            $table->unsignedInteger('floors')->nullable();
            $table->unsignedInteger('apartments')->nullable();
            $table->string('rif', 15)->nullable();
            $table->integer('user_id')->unsigned()->index('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
