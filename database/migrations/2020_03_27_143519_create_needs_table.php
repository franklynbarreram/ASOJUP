<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('needs')) {
            Schema::create('needs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description');

                $table->unsignedInteger('need_type_id');
                $table->foreign('need_type_id')->references('id')->on('needs_types')->onDelete('cascade');

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
        Schema::dropIfExists('needs');
    }
}
