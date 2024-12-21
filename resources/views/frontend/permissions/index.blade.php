@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$permissions"
        :columns="[
            'title' => 'Title'
        ]"
        route="permissions"
        :can_create="auth()->user() && auth()->user()->can('permission_create')"
        :can_edit="auth()->user() && auth()->user()->can('permission_edit')"
        :can_delete="auth()->user() && auth()->user()->can('permission_delete')"
    />
@endsection 