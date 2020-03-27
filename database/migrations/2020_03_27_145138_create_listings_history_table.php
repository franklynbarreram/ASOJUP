<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('listings_history')) {
            Schema::create('listings_history', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('amount');

                $table->unsignedInteger('inscribed_user_need');
                $table->foreign('inscribed_user_need')->references('id')->on('inscribed_users_needs')->onDelete('cascade');

                $table->unsignedInteger('listing_id');
                $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');

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
        Schema::dropIfExists('listings_history');
    }
}
