@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.faq-categories.update', $faqCategory->id) }}"
        method="PUT"
        title="Edit FAQ Category"
        :model="$faqCategory"
        :fields="[
            'category' => [
                'type' => 'text',
                'label' => 'Category Name',
                'required' => true
            ]
        ]"
    />
@endsection 