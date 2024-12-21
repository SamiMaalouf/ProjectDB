@props(['items', 'columns', 'route', 'can_create' => false, 'can_edit' => false, 'can_delete' => false])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ ucfirst(str_replace('-', ' ', $route)) }}</h5>
        @if($can_create)
            <a href="{{ route('frontend.'.$route.'.create') }}" class="btn btn-primary">
                Create New
            </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        @foreach($columns as $column => $label)
                            <th>{{ $label }}</th>
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            @foreach($columns as $column => $label)
                                <td>
                                    @if(is_array($item->$column))
                                        {{ implode(', ', $item->$column) }}
                                    @else
                                        {{ $item->$column }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('frontend.'.$route.'.show', $item->id) }}" 
                                       class="btn btn-primary btn-sm">
                                        View
                                    </a>
                                    @if($can_edit)
                                        <a href="{{ route('frontend.'.$route.'.edit', $item->id) }}" 
                                           class="btn btn-info btn-sm">
                                            Edit
                                        </a>
                                    @endif
                                    @if($can_delete)
                                        <form action="{{ route('frontend.'.$route.'.destroy', $item->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure?');"
                                              style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('.datatable').DataTable({
            processing: true,
            pageLength: 10,
            responsive: true,
            dom: 'Bfrtip',
            buttons: []
        });
    });
</script>
@endpush 