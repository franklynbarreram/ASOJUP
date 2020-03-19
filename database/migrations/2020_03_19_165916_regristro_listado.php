<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegristroListado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('registro_listado', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cantidad');
            $table->UnsignedInteger('listado_id');
            $table->UnsignedInteger('necesidad_inscrito_id');
            $table->foreign('listado_id')->references('id')->on('listados'); 
            $table->foreign('necesidad_inscrito_id')->references('id')->on('necesidades_inscritos'); 
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
