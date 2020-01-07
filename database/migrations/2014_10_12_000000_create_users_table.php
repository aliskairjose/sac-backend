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
            $table->integer( 'cedula', 15 )->unsigned()->nullable(false);
            $table->string( 'phone', 15 )->nullable();
            $table->string( 'email' )->unique()->nullable(false);
            $table->integer( 'id_residency' )->unsigned()->nullable(false);
            $table->integer( 'floor' )->unsigned()->nullable(false);
            $table->string( 'apartment' )->unique()->nullable(false);
            $table->string( 'parking_lot' )->unique()->nullable(false);
            $table->timestamp( 'email_verified_at' )->nullable();
            $table->string( 'password' )->nullable();
            $table->rememberToken();
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
