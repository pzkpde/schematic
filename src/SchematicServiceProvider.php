<?php

namespace Schematic;

use Illuminate\Support\ServiceProvider;

class SchematicServiceProvider extends ServiceProvider
{
    public function register()
    {
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		$this->loadRoutesFrom(__DIR__.'/../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'schematic');

		$this->app->bind('schemas', function() {
			return [
				'posts' => Models\Post::class,
			];
		});
    }
}