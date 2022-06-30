<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscribedUserRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscribed_users_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inscribed_user_id');
            $table->morphs('entity');

            $table->foreign('inscribed_user_id')
                ->references('id')
                ->on('inscribed_users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscribed_users_relationships');
    }
}
