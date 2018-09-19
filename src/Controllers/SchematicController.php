<?php

namespace Schematic\Controllers;

use Illuminate\Routing\Controller;
use Schematic\Support\Schema;

class SchematicController extends Controller
{
	protected $schemas = null;

	public function index()
	{
		$schemas = app('schemas');

		return view('schematic::index', [
			'items' => array_keys($schemas),
		]);
	}

	public function table(string $schema)
	{
		$schema = new Schema($schema);

		$entity = $schema->getEntity($schema);
		$fields = $schema->getFields($schema)->filter(function($field) {
			return $field->isVisible('table');
		});

		$query = $entity::query();

		foreach ($fields as $field) {

			if ($field instanceof \Schematic\Support\Relation) {
				$query->with($field->getField());
				$query->withCount($field->getField());
			}
		}

		$order = request('order');
		$by = request('by', 'asc');

		if ($order && $by) {
			$query->orderBy($order, $by);
		}

		$items = $query->paginate();

		return view('schematic::table', [
			'schema' => $schema,
			'fields' => $fields,
			'items' => $items,
		]);
	}

	public function entry(string $schema, int $id = null)
	{
		$schema = new Schema($schema);

		$entity = $schema->getEntity($schema);
		$fields = $schema->getFields($schema)->filter(function($field) {
			return $field->isVisible('form');
		});

		$item = $entity::findOrNew($id);

		return view('schematic::entry', [
			'schema' => $schema,
			'fields' => $fields,
			'item' => $item,
		]);
	}

	public function store(string $schema, int $id = null)
	{
		$schema = new Schema($schema);

		$entity = $schema->getEntity($schema);
		$fields = $schema->getFields($schema)->filter(function($field) {
			return $field->isVisible('form');
		});

		$item = $entity::findOrNew($id);

		$errors = [];
		foreach ($fields as $field) {
			$validated = $field->validate(request()->all());
			if ($validated !== true) {
				$errors[] = $validated;
			}
		}

		if (empty($errors) === false) {
			return redirect()->back()->with('errors', $errors);
		}

		$item->fill(request()->all());
		$item->save();

		foreach ($fields as $field) {
			if ($field instanceof \Schematic\Support\Relation) {
				if ($field->isSingle() === false) {
					try {
						$item->{$field->getField()}()->sync(request($field->getField()));
					} catch (\Exception $e) {
					}
				}
			}
		}

		return request('submit') === 'apply'
			? redirect()->route('schematic::entry.update', ['schema' => $schema, 'id' => $item->id])->with('success', 'Saved success.')
			: redirect()->route('schematic::table', ['schema' => $schema])->with('success', 'Saved success.')
		;
	}
}