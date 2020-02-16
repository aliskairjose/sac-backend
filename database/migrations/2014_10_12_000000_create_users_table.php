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
            $table->string( 'cedula', 15 )->index('cedula')->nullable(true);
            $table->string( 'phone', 15 )->nullable(true);
            $table->string( 'email' )->unique()->nullable(false);
            $table->integer( 'building_id' )->unsigned()->nullable(true);
            $table->string('floor', 2)->nullable(true);
            $table->string('apartment', 10)->unique()->nullable(true);
            $table->string('parking_lot', 4)->unique()->nullable();
            $table->string( 'password' )->nullable(false);
            $table->timestamps();
            $table->foreign('building_id')->references('id')->on('buildings');

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
