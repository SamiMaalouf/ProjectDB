@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$users"
        :columns="[
            'name' => 'Name',
            'email' => 'Email',
            'roles' => 'Roles',
            'email_verified_at' => 'Verified'
        ]"
        route="users"
        :can_create="auth()->user() && auth()->user()->can('user_create')"
        :can_edit="auth()->user() && auth()->user()->can('user_edit')"
        :can_delete="auth()->user() && auth()->user()->can('user_delete')"
    />
@endsection 