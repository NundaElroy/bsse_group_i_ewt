<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Bookings;
use App\Models\Event;
use Illuminate\Support\Facades\DB; 

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


        //piec chart fir visitors
        $visitorTypes = Visitor::selectRaw('visitor_type, COUNT(*) as total')
        ->groupBy('visitor_type')
        ->get();

        $labels = $visitorTypes->pluck('visitor_type');
        $values = $visitorTypes->pluck('total');

        
        
        // Get visitors grouped by month
        $monthlyVisitors = Visitor::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        $months = $monthlyVisitors->pluck('month')->map(function ($month) {
            return \Carbon\Carbon::create()->month($month)->format('F');
        });

        $monthlyCounts = $monthlyVisitors->pluck('total');

        return view('admin.dashboard', compact(
            'animalCount',
            'employeeCount',
            'visitorCount',
            'bookingCount',
            'totalTickets',
            'income',
            'eventCount',
            'labels',
            'values',
            'months',
            'monthlyCounts'
        ));
    }
}
