<?php

namespace App\Http\Controllers;
use App\Models\Bookings;

use Illuminate\Http\Request;

class ViewBookingsController extends Controller
{
    // Apply the 'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $bookings = Bookings::all();
        return view('admin.viewbookings',compact('bookings'));
    }
}