@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Question Option Details"
        :model="$questionOption"
        :fields="[
            'question.question_text' => [
                'label' => 'Question'
            ],
            'option_text' => [
                'label' => 'Option Text'
            ],
            'correct' => [
                'label' => 'Correct Answer'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('question_option_edit')
        ]"
    />

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Question Context</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <h6>Question:</h6>
                <p>{{ $questionOption->question->question_text }}</p>
                @if($questionOption->question->question_image)
                    <img src="{{ $questionOption->question->question_image->getUrl() }}" 
                         alt="Question Image" 
                         class="img-fluid mt-2" 
                         style="max-width: 300px;">
                @endif
            </div>

            <div>
                <h6>All Options:</h6>
                <ul class="list-group">
                    @foreach($questionOption->question->options as $option)
                        <li class="list-group-item {{ $option->id === $questionOption->id ? 'active' : '' }} {{ $option->correct ? 'list-group-item-success' : '' }}">
                            {{ $option->option_text }}
                            @if($option->correct)
                                <span class="badge bg-success float-end">Correct Answer</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection 