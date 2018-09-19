<div class="form-group">
    <label for="field_{{ $field }}">{{ $title }}</label>
    <select name="{{ $field }}" class="form-control" {{ $single ? '' : 'multiple'}}>
    	@foreach ($related as $entry)
    		@if ($single)
    			<option value="{{ $entry->getKey() }}" $item->$foreign_key == $entry->getKey() ? 'selected="selected"' : '' }}>{{ $entry->$using }}</option>
    		@else
    			<option value="{{ $entry->getKey() }}" {{ in_array($item->$foreign_key, $related_ids) ? 'selected="selected"' : '' }}>{{ $entry->$using }}</option>
    		@endif
    	@endforeach
    </select>
</div>