<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['lessons'])
            ->withCount('lessons')
            ->where('is_published', true)
            ->paginate(12);
            
        return view('frontend.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['lessons']);
        $enrolled = auth()->user()->enrollments->contains('course_id', $course->id);
        
        return view('frontend.courses.show', compact('course', 'enrolled'));
    }
} 