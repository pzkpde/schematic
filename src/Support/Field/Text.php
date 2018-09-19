<?php

namespace Schematic\Support\Field;

class Text extends AbstractField
{
	public function renderFormElement($item)
	{
		return view('schematic::partials.entry.textarea', [
			'value' => $item->{$this->getField()},
			'title' => $this->getTitle(),
			'field' => $this->getField(),
			'rules' => $this->getRules(),
		]);
	}
}