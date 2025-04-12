<?php

namespace App\Http\Controllers;
use App\Models\TicketType;

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
}