<label for="{{ $field->getFieldName() }}">{{ $field->getLabel() }}</label>
<textarea class="form-control"
          id="{{ $field->getFieldName() }}"
          name="{{ $field->getFieldName() }}"{{ $field->isEditable() ? '' : ' disabled' }}>{{ $field->getInputValue($item, $showDatabaseValue) }}</textarea>
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
