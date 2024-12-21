@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="Lesson Details"
        :model="$lesson"
        :fields="[
            'title' => [
                'label' => 'Title'
            ],
            'course.title' => [
                'label' => 'Course'
            ],
            'position' => [
                'label' => 'Position'
            ],
            'short_text' => [
                'label' => 'Short Description'
            ],
            'long_text' => [
                'label' => 'Full Description'
            ],
            'video' => [
                'label' => 'Video',
                'type' => 'file'
            ],
            'thumbnail' => [
                'label' => 'Thumbnail',
                'type' => 'image'
            ],
            'is_published' => [
                'label' => 'Published'
            ],
            'is_free' => [
                'label' => 'Free'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('lesson_edit')
        ]"
    />

    @if($lesson->video)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Lesson Video</h5>
            </div>
            <div class="card-body">
                <div class="ratio ratio-16x9">
                    <video controls>
                        <source src="{{ $lesson->video->getUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    @endif

    @if($lesson->tests?->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Lesson Tests</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($lesson->tests as $test)
                        <a href="{{ route('frontend.tests.show', $test->id) }}" 
                           class="list-group-item list-group-item-action">
                            {{ $test->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection 