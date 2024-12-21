@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$roles"
        :columns="[
            'title' => 'Title',
            'permissions' => 'Permissions'
        ]"
        route="roles"
        :can_create="auth()->user() && auth()->user()->can('role_create')"
        :can_edit="auth()->user() && auth()->user()->can('role_edit')"
        :can_delete="auth()->user() && auth()->user()->can('role_delete')"
    />
@endsection 