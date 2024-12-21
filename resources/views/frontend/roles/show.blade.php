@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Role Details"
        :model="$role"
        :fields="[
            'title' => [
                'label' => 'Title'
            ],
            'permissions' => [
                'label' => 'Permissions',
                'type' => 'array'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('role_edit')
        ]"
    />

    @if($role->users->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Users with this Role</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('frontend.users.show', $user->id) }}" 
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