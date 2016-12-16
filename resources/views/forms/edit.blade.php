<form action="{{ $form->getUpdateRoute($item['id']) }}" method="POST">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @foreach($form->getFields() as $field)
        <div class="form-group{{ $errors->has($field->getFieldName()) ? ' has-error' : '' }}">
            {!! $field->getFormInput($item, true) !!}
        </div>
    @endforeach

    <div class="form-group">
        <button class="btn btn-success">Save</button>
        <a href="{{ $form->getIndexRoute() }}" class="btn btn-info">Back to list</a>
    </div>
</form>
