<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer'
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('location_photos', 'public');
            $data['profile_photo'] = $path;
        }

        Location::create($data);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image',
            'description' => 'nullable|string',
            'capacity' => 'nullable|integer'
        ]);

        $location = Location::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('location_photos', 'public');
            $data['profile_photo'] = $path;
        }

        $location->update($data);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
