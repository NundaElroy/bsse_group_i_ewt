<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|string',
        ]);

        try {
            // Store feedback
            Feedback::create([
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'comment' => $validated['comment'],
                'rating' => $validated['rating'],
            ]);

            // Redirect with success message
            return redirect()->back()->with('success', 'Your feedback has been submitted successfully!');
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Feedback submission failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }
}
