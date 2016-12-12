<div class="pull-right">
    <a href="{{ $form->getCreateRoute() }}" class="btn btn-success">Add new user</a>
</div>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        @foreach($form->fields as $field)
            <th>{{ $field->getLabel() }}</th>
        @endforeach
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $loop->iteration + $skipped }}</td>
            @foreach($form->fields as $field)
                <td>{{ $item[$field->getDatabaseField()] }}</td>
            @endforeach
            <td>
                <a href="{{ $form->getShowRoute($item['id']) }}">View</a> |
                <a href="{{ $form->getEditRoute($item['id']) }}">Edit</a> |
                <a href="#">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $items->links() }}