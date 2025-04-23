<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{

    //  'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('manager')->get();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = \App\Models\Employee::all();
        return view('inventory.form', compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'inventory_type' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'employee_id' => 'required|exists:employees,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('inventories', 'public');
        }

        Inventory::create($validated);

        return redirect()->route('inventories.index')->with('success', 'Inventory created successfully.');
    }


    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $employees = \App\Models\Employee::all();

        return view('inventory.edit', compact('inventory', 'employees'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inventory = Inventory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'inventory_type' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'employee_id' => 'required|exists:employees,id',
        ]);

        if ($request->hasFile('image')) {
            // Optionally delete old image if needed
            if ($inventory->image && Storage::disk('public')->exists($inventory->image)) {
                Storage::disk('public')->delete($inventory->image);
            }

            $validated['image'] = $request->file('image')->store('inventories', 'public');
        }

        $inventory->update($validated);

        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail($id);
    
        if ($inventory->image && Storage::disk('public')->exists($inventory->image)) {
            Storage::disk('public')->delete($inventory->image);
        }
    
        $inventory->delete();
    
        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully.');
    }
    
}
