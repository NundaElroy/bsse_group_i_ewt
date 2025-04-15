<?php

namespace App\Http\Controllers;
use App\Models\TicketType;
use App\Models\Visitor;
use App\Models\Bookings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class BookTicketController extends Controller
{
    public function index()
    {
        // Fetch all ticket types from the database and group by visitor category 
        // [
        //     'Ugandan Citizen' => [ ...array of adult/child tickets... ],
        //     'Foreign Visitor' => [ ...array of adult/child tickets... ],
        // ]
        
        $ticketTypes = TicketType::all()->groupBy('visitor_category');
       
        return view('tickets.book_ticket',compact('ticketTypes'));
    }




    public function store(Request $request)
    {   

        Log::info('Booking method entered');

        $validated = $request->validate([
            'visitor_type' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'document_type' => 'required|string',
            'id_number' => 'required|string|max:100',
            'adult' => 'required|integer|min:0',
            'child' => 'required|integer|min:0',
            'date' => 'required|date|after_or_equal:today',
            'total_amount' => 'required|string',
            'payment_method' => 'required|string',
            'comments' => 'nullable|string',
        ]);

        try {
            Log::info('Booking process started.', ['email' => $validated['email']]);

            DB::transaction(function () use ($validated) {
                $visitor = Visitor::create([
                    'full_name' => $validated['name'],
                    'email' => $validated['email'],
                    'address' => $validated['address'],
                    'visitor_type' => $validated['visitor_type'],
                    'document_type' => $validated['document_type'],
                    'document_number' => $validated['id_number'],
                ]);

                Log::info('Visitor created.', ['visitor_id' => $visitor->id]);

                Bookings::create([
                    'visitor_id' => $visitor->id,
                    'visit_date' => $validated['date'],
                    'adult_tickets' => $validated['adult'],
                    'child_tickets' => $validated['child'],
                    'total_amount' => (int) preg_replace('/[^0-9]/', '', $validated['total_amount']),
                    'payment_method' => $validated['payment_method'],
                    'special_requests' => $validated['comments'],
                ]);

                Log::info('Booking created successfully for visitor.', ['visitor_id' => $visitor->id]);
            });

            return redirect()->route('book_ticket')->with('success', 'Ticket booked successfully!');
        } catch (\Exception $e) {
            Log::error('Booking failed.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return back()
            ->withInput()
            ->withErrors(['general' => 'Something went wrong. Please try again.']);
        }
    }


   
}