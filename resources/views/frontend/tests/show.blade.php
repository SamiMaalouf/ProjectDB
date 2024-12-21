@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Test Details"
        :model="$test"
        :fields="[
            'title' => [
                'label' => 'Title'
            ],
            'course.title' => [
                'label' => 'Course'
            ],
            'lesson.title' => [
                'label' => 'Lesson'
            ],
            'description' => [
                'label' => 'Description'
            ],
            'published' => [
                'label' => 'Published'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('test_edit')
        ]"
    />

    @if($test->questions->count() > 0)
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Test Questions</h5>
                @if(auth()->user() && auth()->user()->can('question_create'))
                    <a href="{{ route('frontend.questions.create', ['test_id' => $test->id]) }}" 
                       class="btn btn-primary">
                        Add Question
                    </a>
                @endif
            </div>
            <div class="card-body">
                @foreach($test->questions as $question)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title">{{ $question->question_text }}</h6>
                            @if($question->question_image)
                                <img src="{{ $question->question_image->getUrl() }}" 
                                     alt="Question Image" 
                                     class="img-fluid mb-3" 
                                     style="max-width: 300px;">
                            @endif
                            <ul class="list-group">
                                @foreach($question->options as $option)
                                    <li class="list-group-item {{ $option->correct ? 'list-group-item-success' : '' }}">
                                        {{ $option->option_text }}
                                        @if($option->correct)
                                            <span class="badge bg-success float-end">Correct</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @if(auth()->user() && auth()->user()->can('question_edit'))
                                <div class="mt-3">
                                    <a href="{{ route('frontend.questions.edit', $question->id) }}" 
                                       class="btn btn-info btn-sm">
                                        Edit Question
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($test->results->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Test Results</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($test->results as $result)
                                <tr>
                                    <td>{{ $result->student->name }}</td>
                                    <td>{{ $result->score }}%</td>
                                    <td>{{ $result->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection 