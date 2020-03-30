<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscribedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inscribed_users')) {
            Schema::create('inscribed_users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->string('password');
                $table->string('email')->unique();
                $table->string('identification');
                $table->string('cicpc_id');
                $table->string('phone');
                $table->text('address');
                $table->boolean('active')->default(true);
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
        Schema::dropIfExists('inscribed_users');
    }
}
