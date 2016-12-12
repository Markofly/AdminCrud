<label for="{{ $field->getDatabaseField() }}">{{ $field->getLabel() }}</label>
<textarea class="form-control"
          id="{{ $field->getDatabaseField() }}"
          name="{{ $field->getDatabaseField() }}">{{ $field->getInputValue($item, $showDatabaseValue) }}</textarea>
@if ($errors->has($field->getDatabaseField()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getDatabaseField()) }}</strong>
    </span>
@endif