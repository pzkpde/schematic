<?php

namespace Schematic\Support\Field\Relation;

use Schematic\Support\Field\AbstractField;

class AbstractRelation extends AbstractField
{
	protected $using = null;

	public function using($using)
	{
		$this->using = $using;
		return $this;
	}

	public function getUsing()
	{
		return $this->using;
	}

	public function getRelation()
	{
		return $this->getEntity()->{$this->getField()};
	}

	public function getRelationQuery()
	{
		return $this->getEntity()->{$this->getField()}();
	}

	public function isSingle()
	{
		$relation = $this->getRelationQuery();

		return $relation instanceof \Illuminate\Database\Eloquent\Relations\BelongsTo
			or $relation instanceof \Illuminate\Database\Eloquent\Relations\HasOne;
	}

	public function renderTableRow($item)
	{
		$field = $item->{$this->getField()};

		if ($this->hasFlag('countable')) {
			return $item->{$this->getField() . '_count'};
		}

		$using = $this->getUsing();
		if ($this->getUsing() !== null) {

			$items = [];

			if ($this->isSingle())  {

				// single

				$value = $field->$using;
				if ($this->hasFlag('editable')) {
					$value = $this->getEditable($value, $field->getKey());
				}

				$items[] = $value;

			} else {

				// multiple
				$child = [];
				foreach ($field as $entry) {
					$child[] = $this->getEditable($entry->$using, $entry->getKey());
				}

				$value = $child;

				$items[] = implode(', ', $value);
			}

			return implode(', ', $items);
		}

		if ($this->hasFlag('editable')) {
			$field = $this->getEditable($field, $field->getKey());
		}

		return $field;
	}

	public function getEditable($value, $id)
	{
		return view('schematic::partials.table.link', [
			'value' => $value,
			'url' => route('schematic::entry.update', [
				'schema' => $this->getField(),
				'id' => $id,
			]),
		]);
	}
}