<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurvivorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('survivors')) {
            Schema::create('survivors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->string('email')->nullable();
                $table->string('phone');
                $table->string('identification');
                $table->text('address');
    
                $table->unsignedInteger('inscribed_user_id');
                $table->foreign('inscribed_user_id')->references('id')->on('inscribed_users')->onDelete('cascade'); 
                
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
        Schema::dropIfExists('survivors');
    }
}
