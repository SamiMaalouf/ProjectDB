@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$lessons"
        :columns="[
            'title' => 'Title',
            'course.title' => 'Course',
            'position' => 'Position',
            'is_published' => 'Published',
            'is_free' => 'Free'
        ]"
        route="lessons"
        :can_create="auth()->user() && auth()->user()->can('lesson_create')"
        :can_edit="auth()->user() && auth()->user()->can('lesson_edit')"
        :can_delete="auth()->user() && auth()->user()->can('lesson_delete')"
    />
@endsection 