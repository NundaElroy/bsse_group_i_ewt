<?php

namespace App\Http\Controllers;

use App\Models\Habitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HabitatController extends Controller
{
    public function index()
    {
        Log::info('HabitatController@index: Fetching all habitats');
        
        try {
            $habitats = Habitat::paginate(10); // Paginate results
            Log::info('HabitatController@index: Successfully retrieved habitats', [
                'count' => $habitats->total(),
                'current_page' => $habitats->currentPage()
            ]);
            
            return view('habitats.index', [
                'habitats' => $habitats,
                'activePage' => 'habitats',
                'title' => 'Habitat Management'
            ]);
        } catch (\Exception $e) {
            Log::error('HabitatController@index: Failed to retrieve habitats', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function create()
    {
        Log::info('HabitatController@create: Displaying habitat creation form');
        
        try {
            return view('habitats.create', [
                'activePage' => 'habitats',
                'title' => 'Add New Habitat'
            ]);
        } catch (\Exception $e) {
            Log::error('HabitatController@create: Failed to load form data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function store(Request $request)
    {
        Log::info('HabitatController@store: Attempting to create new habitat', [
            'request_data' => $request->all()
        ]);
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string',
                'capacity' => 'nullable|integer'
            ]);
            
            Log::info('HabitatController@store: Validation passed', [
                'name' => $request->name
            ]);
            
            $habitat = Habitat::create($validated);
            
            Log::info('HabitatController@store: Habitat created successfully', [
                'habitat_id' => $habitat->id,
                'name' => $habitat->name
            ]);
            
            return redirect()->route('habitats.index')->with('success', 'Habitat added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('HabitatController@store: Validation failed', [
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('HabitatController@store: Failed to create habitat', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function edit(Habitat $habitat)
    {
        Log::info('HabitatController@edit: Fetching habitat for editing', [
            'habitat_id' => $habitat->id,
            'name' => $habitat->name
        ]);
        
        try {
            return view('habitats.edit', [
                'habitat' => $habitat,
                'activePage' => 'habitats',
                'title' => 'Edit Habitat'
            ]);
        } catch (\Exception $e) {
            Log::error('HabitatController@edit: Failed to retrieve habitat for editing', [
                'habitat_id' => $habitat->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function update(Request $request, Habitat $habitat)
    {
        Log::info('HabitatController@update: Attempting to update habitat', [
            'habitat_id' => $habitat->id,
            'name' => $habitat->name,
            'request_data' => $request->all()
        ]);
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string',
                'capacity' => 'nullable|integer'
            ]);
            
            Log::info('HabitatController@update: Validation passed', [
                'habitat_id' => $habitat->id
            ]);
            
            $habitat->update($validated);
            
            Log::info('HabitatController@update: Habitat updated successfully', [
                'habitat_id' => $habitat->id
            ]);
            
            return redirect()->route('habitats.index')->with('success', 'Habitat updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('HabitatController@update: Validation failed', [
                'habitat_id' => $habitat->id,
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('HabitatController@update: Failed to update habitat', [
                'habitat_id' => $habitat->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function destroy(Habitat $habitat)
    {
        Log::info('HabitatController@destroy: Attempting to delete habitat', [
            'habitat_id' => $habitat->id,
            'name' => $habitat->name
        ]);
        
        try {
            $habitat->delete();
            
            Log::info('HabitatController@destroy: Habitat deleted successfully', [
                'habitat_id' => $habitat->id
            ]);
            
            return redirect()->route('habitats.index')->with('success', 'Habitat deleted successfully.');
        } catch (\Exception $e) {
            Log::error('HabitatController@destroy: Failed to delete habitat', [
                'habitat_id' => $habitat->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
