@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.faq-questions.store') }}"
        title="Create FAQ Question"
        :fields="[
            'category_id' => [
                'type' => 'select',
                'label' => 'Category',
                'required' => true,
                'options' => $categories
            ],
            'question' => [
                'type' => 'text',
                'label' => 'Question',
                'required' => true
            ],
            'answer' => [
                'type' => 'textarea',
                'label' => 'Answer',
                'required' => true
            ]
        ]"
    />
@endsection 