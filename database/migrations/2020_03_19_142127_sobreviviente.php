<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sobreviviente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sobrevivientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cicpc_id');
            $table->string('telefono');
            $table->string('cedula');
            $table->text('direccion');
            $table->UnsignedInteger('inscrito_id');
            $table->timestamps();

            $table->foreign('inscrito_id')->references('id')->on('inscritos'); 
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
