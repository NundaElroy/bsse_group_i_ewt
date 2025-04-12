<?php

namespace App\Http\Controllers;
use App\Models\TicketType;

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
        // Fetch all ticket types from the database
        $ticketTypes = TicketType::all();

        // Pass them to the Blade view
        return view('admin.tickets', compact('ticketTypes'));
    }
}