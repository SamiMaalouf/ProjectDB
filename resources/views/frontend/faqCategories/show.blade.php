@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="FAQ Category Details"
        :model="$faqCategory"
        :fields="[
            'category' => [
                'label' => 'Category Name'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('faq_category_edit')
        ]"
    />

    @if($faqCategory->faqQuestions->count() > 0)
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Questions in this Category</h5>
                @if(auth()->user() && auth()->user()->can('faq_question_create'))
                    <a href="{{ route('frontend.faq-questions.create', ['category_id' => $faqCategory->id]) }}" 
                       class="btn btn-primary">
                        Add Question
                    </a>
                @endif
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($faqCategory->faqQuestions as $question)
                        <div class="list-group-item">
                            <h6 class="mb-1">{{ $question->question }}</h6>
                            <p class="mb-1">{{ $question->answer }}</p>
                            @if(auth()->user() && auth()->user()->can('faq_question_edit'))
                                <div class="mt-2">
                                    <a href="{{ route('frontend.faq-questions.edit', $question->id) }}" 
                                       class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection 