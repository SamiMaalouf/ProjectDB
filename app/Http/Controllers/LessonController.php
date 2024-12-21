<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        $course = $lesson->course;
        $progress = auth()->user()->calculateCourseProgress($course);
        
        $previousLesson = $course->lessons()
            ->where('position', '<', $lesson->position)
            ->orderBy('position', 'desc')
            ->first();
            
        $nextLesson = $course->lessons()
            ->where('position', '>', $lesson->position)
            ->orderBy('position')
            ->first();

        return view('frontend.lessons.show', compact(
            'lesson',
            'course',
            'progress',
            'previousLesson',
            'nextLesson'
        ));
    }
} 