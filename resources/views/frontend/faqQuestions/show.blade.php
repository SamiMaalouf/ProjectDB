@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="FAQ Question Details"
        :model="$faqQuestion"
        :fields="[
            'category.category' => [
                'label' => 'Category'
            ],
            'question' => [
                'label' => 'Question'
            ],
            'answer' => [
                'label' => 'Answer'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('faq_question_edit')
        ]"
    />
@endsection 