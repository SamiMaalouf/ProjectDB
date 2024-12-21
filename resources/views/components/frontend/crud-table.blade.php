<div class="container">
    <div class="card">
        @if($canCreate)
            <div class="card-header">
                <a href="{{ route($route.'.create') }}" class="btn btn-primary">
                    Create New
                </a>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            @foreach($columns as $key => $label)
                                <th>{{ $label }}</th>
                            @endforeach
                            @if($canEdit || $canDelete)
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                @foreach($columns as $key => $label)
                                    <td>{{ data_get($item, $key) }}</td>
                                @endforeach
                                @if($canEdit || $canDelete)
                                    <td>
                                        @if($canEdit)
                                            <a href="{{ route($route.'.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @endif
                                        @if($canDelete)
                                            <form action="{{ route($route.'.destroy', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 