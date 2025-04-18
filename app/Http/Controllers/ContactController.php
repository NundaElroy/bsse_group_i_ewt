<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Helpers\MailHelper;
use Carbon\Carbon;

class ContactController extends Controller
{
    //test change for viewing contact form
    public function show()
{
    return view('contact');
}


    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',

        ]);

        try {
            // Store feedback
            Feedback::create([
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'comment' => $validated['comment'],
                'rating' => $validated['rating'],
                //added date field using Carbon
                 'date' => Carbon::now(),
            ]);
            //email content format

            $body = "<h1>New Contact Form Submission</h1>";
            $body .= "<p><strong>Email:</strong> {$validated['email']}</p>";
            $body .= "<p><strong>Subject:</strong> {$validated['subject']}</p>";
            $body .= "<p><strong>Comment:</strong> {$validated['comment']}</p>";
            $body .= "<p><strong>Rating:</strong> {$validated['rating']}</p>";
            
            $emailResult = MailHelper::sendEmail(
                env('MAIL_FROM_ADDRESS'), // Send to your email
                $validated['subject'],     // Use form subject
                $body,
                $validated['email']       // Sender's email as the name
            );

            if (!$emailResult['success']) {
                Log::error('Email sending failed: ' . $emailResult['message']);
                return redirect()->back()->with('error', 'Feedback saved, but email could not be sent. Please try again.')->withInput();
            }

            // Redirect with success message
            return redirect()->back()->with('success', 'Your feedback has been submitted successfully!');
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Feedback submission failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

}
