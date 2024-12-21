@extends('frontend.layouts.app')

@section('content')
    <x-frontend.form
        action="{{ route('frontend.tests.store') }}"
        title="Create Test"
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
            'lesson_id' => [
                'type' => 'select',
                'label' => 'Lesson',
                'options' => $lessons
            ],
            'description' => [
                'type' => 'textarea',
                'label' => 'Description'
            ],
            'published' => [
                'type' => 'checkbox',
                'label' => 'Published'
            ]
        ]"
    />
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#course_id').on('change', function() {
            var courseId = $(this).val();
            if (courseId) {
                $.ajax({
                    url: '/api/course-lessons/' + courseId,
                    type: 'GET',
                    success: function(data) {
                        var lessonSelect = $('#lesson_id');
                        lessonSelect.empty();
                        lessonSelect.append('<option value="">Please select</option>');
                        $.each(data, function(key, value) {
                            lessonSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#lesson_id').empty();
            }
        });
    });
</script>
@endpush 