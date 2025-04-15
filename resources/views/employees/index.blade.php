@extends('layouts.admin.layout')

@section('title', 'Employee Management')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Employee Management</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Contract</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        {{-- Combine first and last name properly --}}
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>

                        <td>{{ $employee->role }}</td>
                        <td>{{ $employee->phone ?? 'N/A' }}</td>
                        <td>{{ $employee->email ?? 'N/A' }}</td>
                        <td>{{ ucfirst($employee->status) }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($employee->contract_start_date)->format('M d, Y') }} –
                            {{ $employee->contract_end_date ? \Carbon\Carbon::parse($employee->contract_end_date)->format('M d, Y') : 'Ongoing' }}
                        </td>
                        
                        {{-- Display salary in UGX with commas --}}
                        <td>{{ $employee->salary ? 'UGX ' . number_format($employee->salary) : 'N/A' }}</td>

                        <td class="actions">
                            <a href="{{ route('employees.edit', $employee) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">No employees found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
@endsection
