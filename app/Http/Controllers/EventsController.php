<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
class EventsController extends Controller
{
    //  'auth' middleware to this controller
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

        return redirect()->route('events.index')->with('success', 'Event created!');
    }


    public function edit($id)
{
    $event = Event::findOrFail($id);
    $employees = Employee::all();
    
    return view('events.editEvent', compact('event', 'employees'));
}

public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);
    
    $validated = $request->validate([
        'name' => 'required',
        'location' => 'required',
        'description' => 'nullable',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'status' => 'required|in:upcoming,past',
        'employee_id' => 'required|exists:employees,id',
        'image' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
            Storage::disk('public')->delete($event->image_path);
        }
        
        // Store new image
        $path = $request->file('image')->store('events', 'public');
        $validated['image_path'] = $path;
    }

    $event->update($validated);

    return redirect()->route('events.index')->with('success', 'Event updated successfully!');
}

    public function destroy($id)
{
    $event = Event::findOrFail($id);
    
    // Delete the image file if it exists
    if ($event->image_path && Storage::disk('public')->exists($event->image_path)) {
        Storage::disk('public')->delete($event->image_path);
    }
    
    $event->delete();
    
    return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
}

}