<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Bookings;
use App\Models\Event;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Apply the 'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Count records in each model
        $animalCount = Animal::count();
        $employeeCount = Employee::count();
        $visitorCount = Visitor::count();
        $bookingCount = Bookings::count();
        $eventCount  = Event::count();
        
        // Calculate total tickets (adult + child)
        $totalAdultTickets = Bookings::sum('adult_tickets');
        $totalChildTickets = Bookings::sum('child_tickets');
        $income = Bookings::sum('total_amount');
        $totalTickets = $totalAdultTickets + $totalChildTickets;
        
        return view('admin.dashboard', compact(
            'animalCount',
            'employeeCount',
            'visitorCount',
            'bookingCount',
            'totalTickets',
            'income',
            'eventCount'
        ));
    }
}
