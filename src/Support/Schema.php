<?php

namespace Schematic\Support;

class Schema
{
	protected $schema;
	protected $entity;
	protected $fields;

	public function __construct(string $schema)
	{
		$schemas = app('schemas');
		if (isset($schemas[$schema]) === false) {
			throw new Exception('Schema "' . $schema . '" not found.');
		}

		$entity = $schemas[$schema];

		if (method_exists($entity, 'fields') === false) {
			throw new Exception('Method "fields" not found in "' . $entity . '".');
		}

		$fields = $entity::fields();
		if (is_array($fields) === false) {
			throw new Exception('Method "fields" from "' . $entity . '" returns invalid array.');
		}

		foreach ($fields as $index => $field) {
			$fields[$index]->setSchema($schema);
			$fields[$index]->setEntity($entity);
		}

		$this->schema = $schema;
		$this->entity = $entity;
		$this->fields = collect($fields);
	}

	public function getSchema()
	{
		return $this->schema;
	}

	public function getEntity()
	{
		return $this->entity;
	}

	public function getFields()
	{
		return $this->fields;
	}
}