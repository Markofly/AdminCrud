<label>{{ $field->getLabel() }}</label>
@foreach($field->getMultipleData() as $checkbox)
    <div class="checkbox">
        <label>
            <input type="checkbox" name="{{ $field->getFieldName() }}" value="{{ $checkbox['value'] }}">
            {{ $checkbox['label'] }}
        </label>
    </div>
@endforeach
@if ($errors->has($field->getFieldName()))
    <span class="help-block">
        <strong>{{ $errors->first($field->getFieldName()) }}</strong>
    </span>
@endif
