@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Question Details"
        :model="$question"
        :fields="[
            'test.title' => [
                'label' => 'Test'
            ],
            'question_text' => [
                'label' => 'Question Text'
            ],
            'points' => [
                'label' => 'Points'
            ],
            'question_image' => [
                'label' => 'Question Image',
                'type' => 'image'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('question_edit')
        ]"
    />

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Question Options</h5>
            @if(auth()->user() && auth()->user()->can('question_option_create'))
                <a href="{{ route('frontend.question-options.create', ['question_id' => $question->id]) }}" 
                   class="btn btn-primary">
                    Add Option
                </a>
            @endif
        </div>
        <div class="card-body">
            @if($question->options->count() > 0)
                <div class="list-group">
                    @foreach($question->options as $option)
                        <div class="list-group-item {{ $option->correct ? 'list-group-item-success' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $option->option_text }}</h6>
                                    @if($option->correct)
                                        <span class="badge bg-success">Correct Answer</span>
                                    @endif
                                </div>
                                @if(auth()->user() && auth()->user()->can('question_option_edit'))
                                    <a href="{{ route('frontend.question-options.edit', $option->id) }}" 
                                       class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No options added yet.</p>
            @endif
        </div>
    </div>
@endsection 