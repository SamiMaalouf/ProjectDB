@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.questions.store') }}"
        title="Create Question"
        :fields="[
            'test_id' => [
                'type' => 'select',
                'label' => 'Test',
                'required' => true,
                'options' => $tests
            ],
            'question_text' => [
                'type' => 'textarea',
                'label' => 'Question Text',
                'required' => true
            ],
            'points' => [
                'type' => 'number',
                'label' => 'Points',
                'required' => true,
                'help' => 'Number of points for correct answer'
            ],
            'question_image' => [
                'type' => 'file',
                'label' => 'Question Image',
                'help' => 'Upload an optional image for the question'
            ]
        ]"
    />

    @if(request()->has('test_id'))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Question Options</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">You can add options after creating the question.</p>
            </div>
        </div>
    @endif
@endsection 