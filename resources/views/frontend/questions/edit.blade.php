@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.questions.update', $question->id) }}"
        method="PUT"
        title="Edit Question"
        :model="$question"
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
                'help' => 'Upload a new image for the question'
            ]
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
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $option->option_text }}</h6>
                                @if($option->correct)
                                    <span class="badge bg-success">Correct Answer</span>
                                @endif
                            </div>
                            <div class="btn-group" role="group">
                                @if(auth()->user() && auth()->user()->can('question_option_edit'))
                                    <a href="{{ route('frontend.question-options.edit', $option->id) }}" 
                                       class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                @endif
                                @if(auth()->user() && auth()->user()->can('question_option_delete'))
                                    <form action="{{ route('frontend.question-options.destroy', $option->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure?');"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
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