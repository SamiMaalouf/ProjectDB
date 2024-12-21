@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.courses.update', $course->id) }}"
        method="PUT"
        title="Edit Course"
        :model="$course"
        :fields="[
            'title' => [
                'type' => 'text',
                'label' => 'Title',
                'required' => true
            ],
            'description' => [
                'type' => 'textarea',
                'label' => 'Description',
                'required' => true
            ],
            'price' => [
                'type' => 'number',
                'label' => 'Price',
                'required' => true
            ],
            'teacher_id' => [
                'type' => 'select',
                'label' => 'Teacher',
                'required' => true,
                'options' => $teachers
            ],
            'students' => [
                'type' => 'select',
                'label' => 'Students',
                'options' => $students,
                'multiple' => true
            ],
            'thumbnail' => [
                'type' => 'file',
                'label' => 'Thumbnail',
                'help' => 'Upload a new thumbnail image'
            ]
        ]"
    />
@endsection 