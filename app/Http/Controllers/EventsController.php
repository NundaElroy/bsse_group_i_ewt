<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Employee;

class EventsController extends Controller
{
    //  'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $events = Event::all();
        return view('events.viewEvents', compact('events'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('events.eventsForm', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'employee_id' => 'required|exists:employees,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image_path'] = $path;
        }

        Event::create($validated);

        return redirect()->route('events.viewEvents')->with('success', 'Event created!');
    }

}