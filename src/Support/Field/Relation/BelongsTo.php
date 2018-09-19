<?php

namespace Schematic\Support\Field\Relation;

class BelongsTo extends AbstractRelation
{
	public function getSortableField()
	{
		return $this->getRelationQuery()->getForeignKey();
	}

	public function renderFormElement($entry)
	{
		$query = $this->getRelationQuery()->getRelated();
		$items = $query->get();

		$using = $this->getUsing();
		$value = [$entry->{$this->getRelationQuery()->getForeignKey()}];

		$foreign = $this->getRelationQuery()->getOwnerKey();

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