<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('comment')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('anime_id');
            $table->timestamps();

            $table->foreign('user_id', 'photos_fk1')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('anime_id', 'photos_fk2')->references('id')->on('animes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
