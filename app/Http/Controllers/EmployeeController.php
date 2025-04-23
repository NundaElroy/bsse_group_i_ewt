<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    //  'auth' middleware to this controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        Log::info('EmployeeController@index: Fetching employees with pagination');
        
        try {
            $employees = Employee::with('user')->paginate(10);
            Log::info('EmployeeController@index: Successfully retrieved employees', [
                'count' => $employees->total(),
                'current_page' => $employees->currentPage()
            ]);
            
            return view('employees.index', [
                'employees' => $employees,
                'activePage' => 'employees',
                'title' => 'Employee Management'
            ]);
        } catch (\Exception $e) {
            Log::error('EmployeeController@index: Failed to retrieve employees', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function create()
    {
        Log::info('EmployeeController@create: Displaying employee creation form');
        
        try {
            $users = User::all();
            Log::info('EmployeeController@create: Users retrieved for form', [
                'user_count' => $users->count()
            ]);
            
            return view('employees.create', [
                'users' => $users,
                'activePage' => 'employees',
                'title' => 'Add New Employee'
            ]);
        } catch (\Exception $e) {
            Log::error('EmployeeController@create: Failed to load form data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function store(Request $request)
    {
        Log::info('EmployeeController@store: Attempting to create new employee', [
            'request_data' => $request->except(['profile_photo'])
        ]);
        
        try {
            $validated = $request->validate([
                'role' => 'required|string',
                'contract_start_date' => 'required|date',
                'contract_end_date' => 'nullable|date',
                'phone_number' => 'nullable|string',
                'email' => 'nullable|email',
                'salary' => 'nullable|numeric',
                'status' => 'required|in:active,on_leave,terminated',
                'profile_photo' => 'nullable|image|max:4048'
            ]);
            
            Log::info('EmployeeController@store: Validation passed', [
                'user_id' => $request->user_id,
                'role' => $request->role
            ]);
            
            $data = $request->all();
            
            if ($request->hasFile('profile_photo')) {
                Log::info('EmployeeController@store: Processing uploaded profile photo', [
                    'original_name' => $request->file('profile_photo')->getClientOriginalName(),
                    'size' => $request->file('profile_photo')->getSize(),
                    'mime' => $request->file('profile_photo')->getMimeType()
                ]);
                
                try {
                    $path = $request->file('profile_photo')->store('profiles', 'public');
                    $data['profile_photo'] = $path;
                    
                    Log::info('EmployeeController@store: Profile photo stored successfully', [
                        'path' => $path
                    ]);
                } catch (\Exception $e) {
                    Log::error('EmployeeController@store: Failed to store profile photo', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            } else {
                Log::info('EmployeeController@store: No profile photo uploaded');
            }
            
            $employee = Employee::create($data);
            
            Log::info('EmployeeController@store: Employee created successfully', [
                'employee_id' => $employee->id,
                'user_id' => $employee->user_id,
                'role' => $employee->role
            ]);
            
            return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('EmployeeController@store: Validation failed', [
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('EmployeeController@store: Failed to create employee', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function edit(Employee $employee)
    {
        Log::info('EmployeeController@edit: Fetching employee for editing', [
            'employee_id' => $employee->id,
            'user_id' => $employee->user_id
        ]);
        
        try {
            $users = User::all();
            
            Log::info('EmployeeController@edit: Employee and users data retrieved', [
                'employee_id' => $employee->id,
                'user_count' => $users->count()
            ]);
            
            return view('employees.edit', [
                'employee' => $employee,
                'users' => $users,
                'activePage' => 'employees',
                'title' => 'Edit Employee'
            ]);
        } catch (\Exception $e) {
            Log::error('EmployeeController@edit: Failed to retrieve data for editing', [
                'employee_id' => $employee->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function update(Request $request, Employee $employee)
    {
        Log::info('EmployeeController@update: Attempting to update employee', [
            'employee_id' => $employee->id,
            'user_id' => $employee->user_id,
            'request_data' => $request->except(['profile_photo'])
        ]);
        
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'role' => 'required|string',
                'contract_start_date' => 'required|date',
                'contract_end_date' => 'nullable|date',
                'phone_number' => 'nullable|string',
                'email' => 'nullable|email',
                'salary' => 'nullable|numeric',
                'status' => 'required|in:active,on_leave,terminated',
                'profile_photo' => 'nullable|image|max:2048'
            ]);
            
            Log::info('EmployeeController@update: Validation passed', [
                'employee_id' => $employee->id
            ]);
            
            $data = $request->all();
            
            // Store old photo path for potential deletion
            $oldPhoto = $employee->profile_photo;
            
            if ($request->hasFile('profile_photo')) {
                Log::info('EmployeeController@update: Processing new profile photo', [
                    'employee_id' => $employee->id,
                    'original_name' => $request->file('profile_photo')->getClientOriginalName(),
                    'size' => $request->file('profile_photo')->getSize(),
                    'mime' => $request->file('profile_photo')->getMimeType()
                ]);
                
                try {
                    $path = $request->file('profile_photo')->store('profiles', 'public');
                    $data['profile_photo'] = $path;
                    
                    Log::info('EmployeeController@update: New profile photo stored successfully', [
                        'path' => $path
                    ]);
                    
                    // Delete old photo if exists
                    if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                        Storage::disk('public')->delete($oldPhoto);
                        Log::info('EmployeeController@update: Deleted old profile photo', [
                            'old_path' => $oldPhoto
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('EmployeeController@update: Failed to store new profile photo', [
                        'employee_id' => $employee->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }
            } else {
                Log::info('EmployeeController@update: No new profile photo uploaded');
            }
            
            // Track which fields are being modified
            $changedFields = [];
            foreach ($data as $key => $value) {
                if ($employee->{$key} != $value) {
                    $changedFields[$key] = [
                        'from' => $employee->{$key},
                        'to' => $value
                    ];
                }
            }
            
            $employee->update($data);
            
            Log::info('EmployeeController@update: Employee updated successfully', [
                'employee_id' => $employee->id,
                'user_id' => $employee->user_id,
                'changed_fields' => $changedFields
            ]);
            
            return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('EmployeeController@update: Validation failed', [
                'employee_id' => $employee->id,
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('EmployeeController@update: Failed to update employee', [
                'employee_id' => $employee->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function destroy(Employee $employee)
    {
        Log::info('EmployeeController@destroy: Attempting to delete employee', [
            'employee_id' => $employee->id,
            'user_id' => $employee->user_id,
            'role' => $employee->role
        ]);
        
        try {
            // Log employee details before deletion
            Log::info('EmployeeController@destroy: Employee found for deletion', [
                'employee_id' => $employee->id,
                'user_id' => $employee->user_id,
                'role' => $employee->role,
                'has_photo' => !empty($employee->profile_photo)
            ]);
            
            // Delete associated profile photo if exists
            if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
                Storage::disk('public')->delete($employee->profile_photo);
                Log::info('EmployeeController@destroy: Deleted associated profile photo', [
                    'photo_path' => $employee->profile_photo
                ]);
            }
            
            $employee->delete();
            
            Log::info('EmployeeController@destroy: Employee deleted successfully', [
                'employee_id' => $employee->id
            ]);
            
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            Log::error('EmployeeController@destroy: Failed to delete employee', [
                'employee_id' => $employee->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}