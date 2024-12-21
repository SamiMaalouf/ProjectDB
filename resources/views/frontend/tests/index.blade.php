@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$tests"
        :columns="[
            'title' => 'Title',
            'course.title' => 'Course',
            'lesson.title' => 'Lesson',
            'description' => 'Description',
            'published' => 'Published'
        ]"
        route="tests"
        :can_create="auth()->user() && auth()->user()->can('test_create')"
        :can_edit="auth()->user() && auth()->user()->can('test_edit')"
        :can_delete="auth()->user() && auth()->user()->can('test_delete')"
    />
@endsection 