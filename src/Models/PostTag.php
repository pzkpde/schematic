<?php

namespace Schematic\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
	public $timestamps = false;

	public $fillable = ['tag_id', 'post_id'];
}