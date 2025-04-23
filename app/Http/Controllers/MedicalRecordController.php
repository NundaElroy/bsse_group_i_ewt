<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Animal;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{

    //  'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }
   // MedicalRecordController.php

public function index()
{
    // Fetch all medical records from the database
    $medicalRecords = MedicalRecord::all();
    
    // Pass the medical records to the view
    return view('medical_records.index', compact('medicalRecords'));
}

    public function create()
    {
        $animals = Animal::all();
        return view('medical_records.create', compact('animals'));
    }

    public function store(Request $request)
{
    $request->validate([
        'animal_id' => 'required|exists:animals,id',
        'diagnosis' => 'required|string',
        'treatment' => 'required|string',
        'record_date' => 'required|date',
        'procedure_type' => 'required|string', // Add validation
    ]);

    MedicalRecord::create([
        'animal_id' => $request->animal_id,
        'diagnosis' => $request->diagnosis,
        'treatment' => $request->treatment,
        'record_date' => $request->record_date,
        'procedure_type' => $request->procedure_type, // Add this
    ]);

    return redirect()->route('medical-records.index')->with('success', 'Medical record created successfully.');
}


    public function edit(MedicalRecord $medicalRecord)
    {
        $animals = Animal::all();
        return view('medical_records.edit', compact('medicalRecord', 'animals'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'diagnosis' => 'required|string|max:255',
            'treatment' => 'required|string',
            'treatment_date' => 'required|date',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('medical-records.index')->with('success', 'Medical record updated successfully!');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('medical-records.index')->with('success', 'Medical record deleted!');
    }
}
