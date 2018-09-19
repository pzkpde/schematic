<?php

namespace Schematic\Support\Field\Relation;

class HasOne extends AbstractRelation
{
	public function getSortableField()
	{
		$parent_key = $this->getRelationQuery()->getQualifiedParentKeyName();
		return last(explode('.', $parent_key));
	}

	public function renderFormElement($entry)
	{
		$query = $this->getRelationQuery();
		$items = $query->getRelated()->get();

		$using = $this->getUsing();

		$parent_key = $this->getRelationQuery()->getQualifiedParentKeyName();
		$parent_key = last(explode('.', $parent_key));

		$value = [$entry->$parent_key];

		$foreign = $query->getForeignKeyName();

		return view('schematic::partials.entry.select', [
			'field' => $this->getField(),
			'title' => $this->getTitle(),
			'entry' => $entry,
			'items' => $items,
			'using' => $using,
			'multiple' => false,
			'selected' => $value,
			'foreign' => $foreign,
		]);
	}
}