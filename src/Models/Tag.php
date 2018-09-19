<?php

namespace Schematic\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class,
            'post_tags', 'tag_id', 'post_id'
        );
    }
}