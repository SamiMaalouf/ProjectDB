@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.roles.update', $role->id) }}"
        method="PUT"
        title="Edit Role"
        :model="$role"
        :fields="[
            'title' => [
                'type' => 'text',
                'label' => 'Title',
                'required' => true
            ],
            'permissions' => [
                'type' => 'select',
                'label' => 'Permissions',
                'options' => $permissions,
                'multiple' => true,
                'help' => 'Select the permissions for this role'
            ]
        ]"
    />
@endsection 