<?php

namespace Schematic\Support\Field\Relation;

class BelongsToMany extends AbstractRelation
{
	public function getSortableField()
	{
		return null; // TODO
	}

	public function renderFormElement($entry)
	{
		$query = $this->getRelationQuery()->getRelated();
		$items = $query->get();

		$using = $this->getUsing();
		$value = $entry->{$this->getField()}->pluck($query->getKeyName())->toArray();
		$foreign = $query->getKeyName();

		return view('schematic::partials.entry.select', [
			'field' => $this->getField(),
			'title' => $this->getTitle(),
			'entry' => $entry,
			'items' => $items,
			'using' => $using,
			'multiple' => true,
			'selected' => $value,
			'foreign' => $foreign,
		]);
	}
}