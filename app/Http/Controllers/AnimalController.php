<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Habitat;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AnimalController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $animals = Animal::with('location')->get();
        return view('animals.index', compact('animals'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'species' => 'required|string|max:255',
        'age' => 'required|numeric|min:0',
        'gender' => 'nullable|string|max:50',
        'location_id' => 'required|exists:locations,id',
        'date_of_birth' => 'nullable|date',
        'acquisition_date' => 'nullable|date',
        'identification_number' => 'nullable|string|max:255',
        'origin' => 'nullable|string|max:255',
        'dietary_requirements' => 'nullable|string',
        'medical_history' => 'nullable|string',
        'image' => 'nullable|image|max:5120',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('animal_images', 'public');
    }

    $validatedData['image'] = $imagePath;

    $animal = Animal::create($validatedData);

    return redirect()->route('animals.index')->with('success', 'Animal added successfully!');
}

    public function show(string $id)
    {
        //
    }

    public function edit(Animal $animal)
    {
        $locations = Location::all();
        return view('animals.edit', compact('animal', 'locations'));
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string|in:male,female,unknown',
            'location_id' => 'required|exists:locations,id',
            'acquisition_date' => 'required|date',
            'date_of_birth' => 'nullable|date',
            'identification_number' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'dietary_requirements' => 'nullable|string|max:255',
            'medical_history' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4048',
        ]);
    
        if ($request->hasFile('image')) {
            if ($animal->image && Storage::disk('public')->exists($animal->image)) {
                Storage::disk('public')->delete($animal->image);
            }
    
            $validated['image'] = $request->file('image')->store('animals', 'public');
        }
    
        $animal->update($validated);
    
        return redirect()->route('animals.index')->with('success', 'Animal updated successfully!');
    }
    
	public function create()
{
    $locations = Location::all(); // fetch all locations
    return view('animals.create', compact('locations'));
}

public function destroy($id)
{
    $animal = Animal::findOrFail($id);
    $animal->delete();

    return redirect()->route('animals.index')->with('success', 'Animal deleted successfully!');
}

}
