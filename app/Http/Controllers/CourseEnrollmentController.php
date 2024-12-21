<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    public function store(Course $course)
    {
        // Check if user is already enrolled
        if (auth()->user()->enrolledCourses->contains($course)) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Create new enrollment
        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => 'active',
            'payment_method' => 'free',
            'amount_paid' => 0.00
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Successfully enrolled in the course!');
    }
} 