@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Permission Details"
        :model="$permission"
        :fields="[
            'title' => [
                'label' => 'Title'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('permission_edit')
        ]"
    />

    @if($permission->roles->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Roles with this Permission</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permission->roles as $role)
                                <tr>
                                    <td>{{ $role->title }}</td>
                                    <td>
                                        <a href="{{ route('frontend.roles.show', $role->id) }}" 
                                           class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection 