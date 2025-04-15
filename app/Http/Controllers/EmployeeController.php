<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
     $employees = Employee::with('user')->paginate(10);
        return view('employees.index', [
            'employees' => $employees,
            'activePage' => 'employees',
            'title' => 'Employee Management'
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('employees.create', [
            'users' => $users,
            'activePage' => 'employees',
            'title' => 'Add New Employee'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
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

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee)
    {
        $users = User::all();
        return view('employees.edit', [
            'employee' => $employee,
            'users' => $users,
            'activePage' => 'employees',
            'title' => 'Edit Employee'
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
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

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
