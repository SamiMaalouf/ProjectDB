@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.lessons.store') }}"
        title="Create Lesson"
        :fields="[
            'title' => [
                'type' => 'text',
                'label' => 'Title',
                'required' => true
            ],
            'course_id' => [
                'type' => 'select',
                'label' => 'Course',
                'required' => true,
                'options' => $courses
            ],
            'position' => [
                'type' => 'number',
                'label' => 'Position',
                'required' => true
            ],
            'short_text' => [
                'type' => 'textarea',
                'label' => 'Short Description'
            ],
            'long_text' => [
                'type' => 'textarea',
                'label' => 'Full Description',
                'required' => true
            ],
            'video' => [
                'type' => 'file',
                'label' => 'Video',
                'help' => 'Upload lesson video'
            ],
            'thumbnail' => [
                'type' => 'file',
                'label' => 'Thumbnail',
                'help' => 'Upload lesson thumbnail'
            ],
            'is_published' => [
                'type' => 'checkbox',
                'label' => 'Published'
            ],
            'is_free' => [
                'type' => 'checkbox',
                'label' => 'Free'
            ]
        ]"
    />
@endsection 