<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingHistoryTable extends Migration
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

                $table->integer('amount')->nullable();

                $table->unsignedInteger('inscribed_user_medicine_id');
                $table->foreign('inscribed_users_medicine_id')->references('id')->on('inscribed_users_medicines')->onDelete('cascade');

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
