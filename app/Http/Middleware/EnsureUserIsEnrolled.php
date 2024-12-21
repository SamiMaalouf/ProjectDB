<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsEnrolled
{
    public function handle(Request $request, Closure $next)
    {
        $lesson = $request->route('lesson');
        $user = auth()->user();

        // Check if the user is enrolled in the course that contains this lesson
        if (!$user->courses()->where('course_id', $lesson->course_id)->exists()) {
            return redirect()->route('courses.show', $lesson->course_id)
                ->with('error', 'You must be enrolled in this course to access its lessons.');
        }

        return $next($request);
    }
}
