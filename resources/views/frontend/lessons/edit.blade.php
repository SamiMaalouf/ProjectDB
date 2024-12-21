@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.lessons.update', $lesson->id) }}"
        method="PUT"
        title="Edit Lesson"
        :model="$lesson"
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
                'help' => 'Upload new video'
            ],
            'thumbnail' => [
                'type' => 'file',
                'label' => 'Thumbnail',
                'help' => 'Upload new thumbnail'
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