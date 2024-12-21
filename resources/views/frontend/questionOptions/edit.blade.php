@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.question-options.update', $questionOption->id) }}"
        method="PUT"
        title="Edit Question Option"
        :model="$questionOption"
        :fields="[
            'question_id' => [
                'type' => 'select',
                'label' => 'Question',
                'required' => true,
                'options' => $questions
            ],
            'option_text' => [
                'type' => 'text',
                'label' => 'Option Text',
                'required' => true
            ],
            'correct' => [
                'type' => 'checkbox',
                'label' => 'Correct Answer',
                'help' => 'Check if this is the correct answer'
            ]
        ]"
    />
@endsection 