<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->UnsignedInteger('admin_id')->nullable();
            $table->UnsignedInteger('inscrito_id')->nullable(); 
            $table->UnsignedInteger('delegado_id')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins'); 
            $table->foreign('inscrito_id')->references('id')->on('inscritos'); 
            $table->foreign('delegado_id')->references('id')->on('delegados'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
