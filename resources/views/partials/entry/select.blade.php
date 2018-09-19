<div class="form-group">
    <label for="field_{{ $field }}">{{ $title }}</label>
    <select name="{{ $multiple ? $field . '[]' : $field }}" class="form-control" {{ $multiple ? 'multiple' : ''}}>
    	@foreach ($items as $item)
            <option value="{{ $item->$foreign }}" {{ in_array($item->$foreign, $selected) ? 'selected="selected"' : '' }}>{{ $item->$using }}</option>
    	@endforeach
    </select>
</div>