<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('medicines')) {
            Schema::create('medicines', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('concentration');
                $table->integer('box_quantity')->default(1);

                $table->unsignedInteger('medicine_form_id');
                $table->foreign('medicine_form_id')->references('id')->on('medicines_forms')->onDelete('cascade');

                $table->unsignedInteger('medicine_unit_id');
                $table->foreign('medicine_unit_id')->references('id')->on('medicines_units')->onDelete('cascade');
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
        Schema::dropIfExists('medicines');
    }
}
