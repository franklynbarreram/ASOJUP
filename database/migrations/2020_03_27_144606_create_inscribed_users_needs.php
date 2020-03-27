<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscribedUsersNeeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inscribed_users_needs')) {
            Schema::create('inscribed_users_needs', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedInteger('inscribed_user_id');
                $table->foreign('inscribed_user_id')->references('id')->on('inscribed_users')->onDelete('cascade');

                $table->unsignedInteger('need_id');
                $table->foreign('need_id')->references('id')->on('needs')->onDelete('cascade');

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
        Schema::dropIfExists('inscribed_users_needs');
    }
}
