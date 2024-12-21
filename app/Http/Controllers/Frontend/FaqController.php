<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('faqQuestions')->get();
        return view('frontend.faq.index', compact('categories'));
    }
} 