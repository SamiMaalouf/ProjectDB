<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        
        if (Auth::check()) {
            $user = Auth::user();
            
            // Get enrolled courses for student
            $data['enrolled_courses'] = $user->courses()
                ->with(['teacher', 'lessons'])
                ->where('is_published', true)
                ->latest()
                ->take(5)
                ->get();
                
            // Get teaching courses for teacher    
            $data['teaching_courses'] = $user->teaching_courses()
                ->with(['students'])
                ->latest()
                ->take(5)
                ->get();
                
            // Get recent tests
            $data['recent_tests'] = Test::whereHas('course', function($q) use ($user) {
                $q->whereHas('students', function($q) use ($user) {
                    $q->where('id', $user->id);
                });
            })
            ->with(['course'])
            ->latest()
            ->take(5)
            ->get();
        }
        
        // Get featured courses for guests
        $data['featured_courses'] = Course::where('is_published', true)
            ->with(['teacher'])
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', $data);
    }
}
