<label for="{{ $field->getFieldName() }}">{{ $field->getLabel() }}</label>
<select name="{{ $field->getFieldName() }}" id="{{ $field->getFieldName() }}" class="form-control">
    @foreach($field->getMultipleData() as $option)
        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select>
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
