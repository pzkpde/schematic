<div class="form-group">
    <label for="field_{{ $field }}">{{ $title }}</label>
    <textarea class="form-control" id="field_{{ $field }}" name="{{ $field }}" {{ in_array('required', $rules) ? 'required' : '' }}>{!! $value !!}</textarea>
</div>