@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.users.store') }}"
        title="Create User"
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
                'required' => true
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