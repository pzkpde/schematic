<?php

namespace Schematic\Models;

use Illuminate\Database\Eloquent\Model;

use Schematic\Support\Field\{
	Integer,
	Varchar,
	Text,
	Datetime
};

use Schematic\Support\Field\Relation\{
	HasOne,
	HasMany,
	BelongsTo,
	BelongsToMany
};

class Post extends Model
{
    public $fillable = [
        'name', 'description', 'author_id', 'status_id',
    ];

    public static function fields()
    {
		return [

			Integer::make('id')
				->hidden('form')
				->flags('sortable'),

			Varchar::make('name')
				->flags('sortable', 'editable')
				->rules('required'),

			Text::make('description')
				->hidden('table'),

			BelongsTo::make('author')
				->using('name')
				->flags('sortable', 'editable')
				->rules('required', 'exists:users,id'),

			BelongsToMany::make('tags')
				->using('name')
				->flags('sortable', 'editable')
				->rules('exists:tags,id'),

			HasOne::make('status')
				->using('name')
				->flags('sortable')
				->rules('required', 'exists:statuses,id'),

			HasMany::make('comments')
				->hidden('form')
				->flags('sortable', 'countable'),

			Datetime::make('created_at')
				->hidden('form')
				->flags('sortable'),

			Datetime::make('updated_at')
				->hidden('form')
				->flags('sortable'),
		];
    }

    public function author()
    {
        return $this->belongsTo(User::class,
            'author_id', 'id'
        );
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,
            'post_tags', 'post_id', 'tag_id'
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,
            'post_id', 'id'
        );
    }

    public function status()
    {
        return $this->hasOne(Status::class,
            'id', 'status_id'
        );
    }
}