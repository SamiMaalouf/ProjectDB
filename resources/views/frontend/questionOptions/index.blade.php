@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$questionOptions"
        :columns="[
            'question.question_text' => 'Question',
            'option_text' => 'Option',
            'correct' => 'Correct Answer'
        ]"
        route="question-options"
        :can_create="auth()->user() && auth()->user()->can('question_option_create')"
        :can_edit="auth()->user() && auth()->user()->can('question_option_edit')"
        :can_delete="auth()->user() && auth()->user()->can('question_option_delete')"
    />
@endsection 