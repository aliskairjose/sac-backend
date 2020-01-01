<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdificioTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'residencia', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->string( 'name' );
            $table->string( 'acronym' );
            $table->string( 'email' )->unique();
            $table->string( 'state' );
            $table->string( 'providence' );
            $table->string( 'address' );
            $table->string( 'floors' );
            $table->string( 'apartments' );
            $table->string( 'contact' );
            $table->string( 'cedula' );
            $table->timestamp( 'crete_at' );
            $table->timestamps( 'update_at' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'residencia' );
    }
}
