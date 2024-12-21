@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.users.update', $user->id) }}"
        method="PUT"
        title="Edit User"
        :model="$user"
        :fields="[
            'name' => [
                'type' => 'text',
                'label' => 'Name',
                'required' => true
            ],
            'email' => [
                'type' => 'email',
                'label' => 'Email',
                'required' => true
            ],
            'password' => [
                'type' => 'password',
                'label' => 'Password',
                'help' => 'Leave empty to keep current password'
            ],
            'roles' => [
                'type' => 'select',
                'label' => 'Roles',
                'options' => $roles,
                'multiple' => true
            ]
        ]"
    />
@endsection 