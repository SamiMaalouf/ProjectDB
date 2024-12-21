@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$questions"
        :columns="[
            'test.title' => 'Test',
            'question_text' => 'Question',
            'points' => 'Points'
        ]"
        route="questions"
        :can_create="auth()->user() && auth()->user()->can('question_create')"
        :can_edit="auth()->user() && auth()->user()->can('question_edit')"
        :can_delete="auth()->user() && auth()->user()->can('question_delete')"
    />
@endsection 