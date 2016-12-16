<label for="{{ $field->getFieldName() }}">{{ $field->getLabel() }}</label>
<input type="password"
       class="form-control"
       id="{{ $field->getFieldName() }}"
       name="{{ $field->getFieldName() }}">
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
