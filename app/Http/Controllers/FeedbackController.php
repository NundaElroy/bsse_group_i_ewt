<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        // Fetch all feedback, ordered by date descending
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function show($id)
    {
        // Fetch a single feedback by ID
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback-show', compact('feedback'));
    }
}
// orderBy('date', 'desc')
