<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name_avatar')->nullable();
            $table->string('path_avatar')->nullable();
            $table->string('name_hero')->nullable();
            $table->string('path_hero')->nullable();
            $table->string('name_pic01')->nullable();
            $table->string('path_pic01')->nullable();
            $table->string('name_pic02')->nullable();
            $table->string('path_pic02')->nullable();
            $table->string('name_pic03')->nullable();
            $table->string('path_pic03')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_photos');
    }
};
