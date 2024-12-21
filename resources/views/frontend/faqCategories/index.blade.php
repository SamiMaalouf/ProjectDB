@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-frontend.crud-table
                :items="$faqCategories"
                :columns="[
                    'category' => 'Category'
                ]"
                route="faq-categories"
                :can_create="auth()->user() && auth()->user()->can('faq_category_create')"
                :can_edit="auth()->user() && auth()->user()->can('faq_category_edit')"
                :can_delete="auth()->user() && auth()->user()->can('faq_category_delete')"
            />
        </div>
        <div class="col-md-8">
            <div class="accordion" id="faqAccordion">
                @foreach($faqCategories as $category)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $category->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $category->id }}">
                                {{ $category->category }}
                            </button>
                        </h2>
                        <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" 
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                @if($category->faqQuestions->count() > 0)
                                    <div class="list-group">
                                        @foreach($category->faqQuestions as $question)
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
                                @else
                                    <p class="text-muted">No questions in this category.</p>
                                @endif
                                @if(auth()->user() && auth()->user()->can('faq_question_create'))
                                    <div class="mt-3">
                                        <a href="{{ route('frontend.faq-questions.create', ['category_id' => $category->id]) }}" 
                                           class="btn btn-primary">
                                            Add Question
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 