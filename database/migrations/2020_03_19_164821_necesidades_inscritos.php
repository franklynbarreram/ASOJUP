<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NecesidadesInscritos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('necesidades_inscritos', function (Blueprint $table) {
            $table->increments('id');
         
              $table->UnsignedInteger('inscrito_id');
               $table->UnsignedInteger('necesidad_id');
              $table->foreign('inscrito_id')->references('id')->on('inscritos'); 
              $table->foreign('necesidad_id')->references('id')->on('necesidades'); 
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
