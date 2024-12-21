<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCourseEnrollment
{
    public function handle(Request $request, Closure $next)
    {
        $lesson = $request->route('lesson');
        $user = auth()->user();

        if (!$user->enrollments->contains('course_id', $lesson->course_id)) {
            return redirect()->route('courses.show', $lesson->course_id)
                ->with('error', 'You must be enrolled in this course to view lessons.');
        }

        return $next($request);
    }
} 