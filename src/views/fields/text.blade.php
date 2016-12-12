<label for="{{ $field->getDatabaseField() }}">{{ $field->getLabel() }}</label>
<input type="text"
       class="form-control"
       id="{{ $field->getDatabaseField() }}"
       name="{{ $field->getDatabaseField() }}"
       value="{{ $field->getInputValue($item, $showDatabaseValue) }}">
@if ($errors->has($field->getDatabaseField()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getDatabaseField()) }}</strong>
    </span>
@endif