<div class="form-group">
    <label for="field_{{ $field }}">{{ $title }}</label>
    <input type="text" class="form-control" id="field_{{ $field }}" name="{{ $field }}" value="{{ $value }}" {{ in_array('required', $rules) ? 'required' : '' }} />
</div>