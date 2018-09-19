<?php

namespace Schematic\Support\Field;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractField
{
	protected $schema = null;
	protected $entity = null;
	protected $field = null;
	protected $title = null;
	protected $hidden = [];
	protected $flags = [];
	protected $rules = [];

	public function hidden(...$sections)
	{
		$this->hidden = $sections;
		return $this;
	}

	public function flags(...$flags)
	{
		$this->flags = $flags;
		return $this;
	}

	public function rules(...$rules)
	{
		$this->rules = $rules;
		return $this;
	}

	public function title(string $title)
	{
		$this->title = $title;
		return $this;
	}

	public function isHidden(string $section)
	{
		return in_array($section, $this->hidden);
	}

	public function isVisible(string $section)
	{
		return $this->isHidden($section) === false;
	}

	public function getFlags()
	{
		return $this->flags;
	}

	public function hasFlag(string $flag)
	{
		return in_array($flag, $this->flags);
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function hasRule(string $rule)
	{
		return in_array($rule, $this->rules);
	}

	public function getSchema()
	{
		return $this->schema;
	}

	public function getField()
	{
		return $this->field;
	}

	public function getTitle()
	{
		return $this->title ?? ucfirst(str_replace('_', ' ', $this->field));
	}

	/**
	 * Field constructor.
	 *
	 * @param string $field
	 */
	public function __construct(string $field)
	{
		$this->field = $field;
	}

	public function setEntity(string $entity)
	{
		$this->entity = $entity;
		return $this;
	}

	public function setSchema(string $schema)
	{
		$this->schema = $schema;
		return $this;
	}

	/**
	 * Make instance of the current class
	 *
	 * @param string $field
	 * @return static
	 * @throws \Exception
	 */
	public static function make(string $field)
	{
		return new static($field);
	}

	/**
	 * Get instance of currently used model
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function getEntity()
	{
		return new $this->entity();
	}

	/**
	 * Get sortable field
	 *
	 * @return null|string
	 */
	public function getSortableField()
	{
		return $this->field;
	}

	/**
	 * Render field as table row
	 *
	 * @param $item
	 * @return string
	 */
	public function renderTableRow($item)
	{
		$value = $item->{$this->getField()};
		if ($this->hasFlag('editable')) {
			$value = $this->getEditable($value, $item->getKey());
		}

		return view('schematic::partials.table.plain', [
			'value' => $value,
		]);
	}

	/**
	 * Render field as form element
	 *
	 * @param $item
	 * @return mixed
	 */
	public function renderFormElement($item)
	{
		return view('schematic::partials.entry.input', [
			'value' => $item->{$this->getField()},
			'title' => $this->getTitle(),
			'field' => $this->getField(),
			'rules' => $this->getRules(),
		]);
	}

	/**
	 * Render field as link
	 *
	 * @param $value
	 * @param $id
	 * @return mixed
	 */
	public function getEditable($value, $id)
	{
		return view('schematic::partials.table.link', [
			'value' => $value,
			'url' => route('schematic::entry.update', [
				'schema' => $this->getSchema(),
				'id' => $id,
			]),
		]);
	}

	/**
	 * Check the current field with the specified data using field rules.
	 *
	 * @param null|array $data
	 * @return bool
	 */
	public function validate(array $data = null)
	{
		$validator = app('validator')->make($data, [
			$this->getField() => $this->getRules(),
		]);

		return $validator->fails() ? $validator->errors() : true;
	}
}