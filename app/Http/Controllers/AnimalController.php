<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Habitat;
use App\Models\Location;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with('habitat')->get();
        return view('animals.index', compact('animals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|numeric',
            'location_id' => 'required|integer',
            'habitat_id' => 'required|integer',
            'image' => 'nullable|image|max:5120',
            'acquisition_date' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('animal_images', 'public');
        }

        $animal = Animal::create([
            'name' => $request->name,
            'species' => $request->species,
            'age' => $request->age,
            'location_id' => $request->location_id,
            'habitat_id' => $request->habitat_id,
            'image' => $imagePath,
            'acquisition_date' => $request->acquisition_date,
        ]);

        return redirect()->route('animals.index')->with('success', 'Animal added successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Animal $animal)
    {
        $habitats = Habitat::all();
        return view('animals.edit', compact('animal', 'habitats'));
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer',
            'habitat_id' => 'required|exists:habitats,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($animal->image && \Storage::disk('public')->exists($animal->image)) {
                \Storage::disk('public')->delete($animal->image);
            }

            $validated['image'] = $request->file('image')->store('animals', 'public');
        }

        $animal->update($validated);

        return redirect()->route('animals.index')->with('success', 'Animal updated successfully!');
    }
	public function create()
{
    $locations = Location::all(); // fetch all locations
    $habitats = Habitat::all(); // assuming you're already using this

    return view('animals.create', compact('locations', 'habitats'));
}

public function destroy($id)
{
    $animal = Animal::findOrFail($id);
    $animal->delete();

    return redirect()->route('animals.index')->with('success', 'Animal deleted successfully!');
}

}
