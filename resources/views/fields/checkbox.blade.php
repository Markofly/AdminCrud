<div class="checkbox">
    <label>
        <input type="checkbox" name="{{ $field->getFieldName() }}"> {{ $field->getLabel() }}
    </label>
</div>
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
