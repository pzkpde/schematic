<?php

Route::group(['prefix' => 'admin/schema', 'middleware' => 'web', 'namespace' => '\Schematic\Controllers'], function() {
	Route::get('/', 'SchematicController@index')->name('schematic::index');
	Route::get('/{schema}', 'SchematicController@table')->name('schematic::table');
	Route::get('/{schema}/insert', 'SchematicController@entry')->name('schematic::entry.insert');
	Route::get('/{schema}/update/{id}', 'SchematicController@entry')->name('schematic::entry.update');
	Route::post('/{schema}/insert', 'SchematicController@store')->name('schematic::store.insert');
	Route::post('/{schema}/update/{id}', 'SchematicController@store')->name('schematic::store.update');
});