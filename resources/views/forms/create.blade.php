<form action="{{ $form->getStoreRoute() }}" method="POST">

    {{ csrf_field() }}

    @foreach($form->getFields() as $field)
        <div class="form-group{{ $errors->has($field->getFieldName()) ? ' has-error' : '' }}">
            {!! $field->getFormInput() !!}
        </div>
    @endforeach

    <div class="form-group">
        <button class="btn btn-success">Add new</button>
        <a href="{{ $form->getIndexRoute() }}" class="btn btn-info">Back to list</a>
    </div>
</form>
