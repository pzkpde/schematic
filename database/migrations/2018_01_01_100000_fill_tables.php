<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillTables extends Migration
{
    public function up()
    {
		\Schematic\Models\Tag::create(['name' => 'PHP']);
		\Schematic\Models\Tag::create(['name' => 'MySQL']);
		\Schematic\Models\Tag::create(['name' => 'Laravel']);
		\Schematic\Models\Tag::create(['name' => 'Memcached']);
		\Schematic\Models\Tag::create(['name' => 'Redis']);
		\Schematic\Models\Tag::create(['name' => 'Git']);

		\Schematic\Models\Status::create(['name' => 'Published']);
		\Schematic\Models\Status::create(['name' => 'Draft']);

		\Schematic\Models\User::create(['name' => 'admin', 'email' => 'admin@devus.ru', 'password' => bcrypt('admin')]);
		\Schematic\Models\User::create(['name' => 'pzkpde', 'email' => 'pzkdpe@devus.ru', 'password' => bcrypt('pzkpde')]);

		\Schematic\Models\Post::create(['name' => 'Introducing to PHP', 'author_id' => 1, 'status_id' => 1]);
		\Schematic\Models\Post::create(['name' => 'Introducing to Laravel', 'author_id' => 2, 'status_id' => 1]);
		\Schematic\Models\Post::create(['name' => 'Whats new in PHP 7.3', 'author_id' => 1, 'status_id' => 2]);
		\Schematic\Models\Post::create(['name' => 'Whats new in Laravel 5.7', 'author_id' => 2, 'status_id' => 2]);

		\Schematic\Models\Comment::create(['body' => 'Comment about Introducing to PHP', 'author_id' => 1, 'post_id' => 1]);
		\Schematic\Models\Comment::create(['body' => 'Comment about Introducing to PHP (2)', 'author_id' => 2, 'post_id' => 1]);
		\Schematic\Models\Comment::create(['body' => 'Comment about Introducing to Laravel', 'author_id' => 1, 'post_id' => 2]);
		\Schematic\Models\Comment::create(['body' => 'Comment about Introducing to Laravel (2)', 'author_id' => 2, 'post_id' => 2]);
		\Schematic\Models\Comment::create(['body' => 'Comment about Introducing to Laravel (3)', 'author_id' => 1, 'post_id' => 2]);

		\Schematic\Models\PostTag::create(['post_id' => 1, 'tag_id' => 1]);
		\Schematic\Models\PostTag::create(['post_id' => 1, 'tag_id' => 2]);
		\Schematic\Models\PostTag::create(['post_id' => 1, 'tag_id' => 3]);
		\Schematic\Models\PostTag::create(['post_id' => 2, 'tag_id' => 1]);
		\Schematic\Models\PostTag::create(['post_id' => 2, 'tag_id' => 2]);
		\Schematic\Models\PostTag::create(['post_id' => 3, 'tag_id' => 6]);
    }

    public function down()
    {
    }
}