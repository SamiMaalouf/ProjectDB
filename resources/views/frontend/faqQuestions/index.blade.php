@extends('frontend.layouts.app')

@section('content')
    <x-frontend.crud-table
        :items="$faqQuestions"
        :columns="[
            'category.category' => 'Category',
            'question' => 'Question',
            'answer' => 'Answer'
        ]"
        route="faq-questions"
        :can_create="auth()->user() && auth()->user()->can('faq_question_create')"
        :can_edit="auth()->user() && auth()->user()->can('faq_question_edit')"
        :can_delete="auth()->user() && auth()->user()->can('faq_question_delete')"
    />
@endsection 