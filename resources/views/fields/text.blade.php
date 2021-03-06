<label for="{{ $field->getFieldName() }}">{{ $field->getLabel() }}</label>
<input type="text"
       class="form-control"
       id="{{ $field->getFieldName() }}"
       name="{{ $field->getFieldName() }}"
       value="{{ $field->getInputValue($item, $showDatabaseValue) }}"{{ $field->isEditable() ? '' : ' disabled' }}>
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
