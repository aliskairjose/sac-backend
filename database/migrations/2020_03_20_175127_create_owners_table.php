<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false);
            $table->string('surname', 50)->nullable(false);
            $table->string('cedula', 15)->index('cedula')->nullable(true);
            $table->string('phone', 15)->nullable(true);
            $table->string('floor', 2)->nullable(true);
            $table->string('apartment', 10)->unique()->nullable(true);
            $table->string('parking_lot', 4)->unique()->nullable();
            $table->string('password')->nullable(false);
            $table->boolean('main')->nullable(true)->comment('True si pertenece a la Junta de Condominio');
            $table->text('photo')->nullable(true)->comment('Imagen de perfil del usuario');
            $table->unsignedInteger('building_id')->nullable(true);
            $table->unsignedInteger('user_id')->nullable(true);
            $table->foreign('building_id')->references('id')->on('buildings');
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
        Schema::dropIfExists('owners');
    }
}
