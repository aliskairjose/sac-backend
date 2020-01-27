<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 50 )->nullable(false);
            $table->string( 'surname', 50 )->nullable(false);
            $table->string( 'cedula', 15 )->index('cedula')->nullable(false);
            $table->string( 'phone', 15 )->nullable();
            $table->string( 'email' )->unique()->nullable(false);
            $table->string( 'type', 15 )->nullable()->default('PROP')->comment('COND - Condominio, PROP - Propietario');
            $table->integer( 'residency_id' )->unsigned()->nullable(false);
            $table->string('floor', 2)->nullable(false);
            $table->string('apartment', 10)->unique()->nullable(false);
            $table->string('parking_lot', 4)->unique()->nullable();
            $table->string( 'password' )->nullable(false);
            $table->timestamps();

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
}
