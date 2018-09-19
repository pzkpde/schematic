<?php

namespace Schematic\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public $fillable = ['body', 'author_id', 'post_id'];
}