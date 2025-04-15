<?php

namespace App\Http\Controllers;
use App\Models\TicketType;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    //auth middleware for auth
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
    {
        Log::info('Admin accessed the ticket types list.');

        $ticketTypes = TicketType::all();

        return view('admin.tickets', compact('ticketTypes'));
    }

    public function editTicket($id)
    {
        Log::info("Admin is editing ticket type with ID: {$id}");

        $ticket = TicketType::find($id);

        if (!$ticket) {
            Log::warning("Ticket type with ID: {$id} not found.");
            abort(404);
        }

        // Log::info('Ticket found:', [
        //     'id' => $ticket->id,
        //     'name' => $ticket->name,
        //     'visitor_category' => $ticket->visitor_category,
        //     'age_category' => $ticket->age_category,
        //     'price' => $ticket->price,
        // ]);

        return view('admin.editTicket', compact('ticket'));
    }



    public function updateTicket(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'visitor_category' => 'required|in:Ugandan Citizen,Foreign Visitor',
            'age_category' => 'required|in:Adult,Child',
            'price' => 'required|numeric|min:0',
        ]);

        // Find the ticket
        $ticket = TicketType::find($id);

        if (!$ticket) {
            Log::warning("Update failed: Ticket with ID {$id} not found.");
            return redirect()->back()->with('error', 'Ticket not found.');
        }

        // Update the ticket
        $ticket->update($validated);

        Log::info("Ticket updated successfully:", [
            'id' => $ticket->id,
            'name' => $ticket->name,
            'visitor_category' => $ticket->visitor_category,
            'age_category' => $ticket->age_category,
            'price' => $ticket->price,
        ]);

        return redirect()->route('editTicket', $id)->with('success', 'Ticket updated successfully.');
    }



}