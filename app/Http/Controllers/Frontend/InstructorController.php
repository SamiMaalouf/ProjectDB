<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        // Get the admin role
        $adminRole = Role::where('title', 'Admin')->first();
        
        // Get all users with admin role
        $instructors = User::whereHas('roles', function($query) use ($adminRole) {
            $query->where('id', $adminRole->id);
        })->get();

        return view('frontend.instructors.index', compact('instructors'));
    }
} 