<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscribedUsersMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inscribed_users_medicines')) {
            Schema::create('inscribed_users_medicines', function (Blueprint $table) {
                $table->increments('id');
    
                $table->unsignedInteger('inscribed_user_id');
                $table->foreign('inscribed_user_id')->references('id')->on('inscribed_users')->onDelete('cascade');
    
                $table->unsignedInteger('medicine_id');
                $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
    
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscribed_users_medicines');
    }
}
