<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->integer('playlist_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('uid');
            $table->string('title');
            $table->string('url');
            $table->string('thumbnail')->unique();
            $table->integer('views')->default(0);
            $table->longText('description')->nullable();
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->integer('visibility');
            $table->integer('status');
            $table->string('token_id')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
