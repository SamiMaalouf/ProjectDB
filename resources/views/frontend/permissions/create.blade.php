@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.permissions.store') }}"
        title="Create Permission"
        :fields="[
            'title' => [
                'type' => 'text',
                'label' => 'Title',
                'required' => true,
                'help' => 'Enter a unique permission title (e.g., user_create, role_edit)'
            ]
        ]"
    />
@endsection 