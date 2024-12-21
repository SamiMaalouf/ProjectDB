@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.faq-categories.store') }}"
        title="Create FAQ Category"
        :fields="[
            'category' => [
                'type' => 'text',
                'label' => 'Category Name',
                'required' => true
            ]
        ]"
    />
@endsection 