<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->text('body');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}