@extends('layouts.admin.layout')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Medical Records</h2>
        <a href="{{ route('medical-records.create') }}" class="btn btn-primary">Add New Record</a>
    </div>

    @if(session('success'))
    <div style="padding: 12px 20px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724; background-color: #d4edda; font-family: system-ui, -apple-system, sans-serif;">
        {{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Animal</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicalRecords as $record)
                <tr>
                    <td>{{ $record->animal->name }}</td>
                    <td>{{ $record->diagnosis }}</td>
                    <td>{{ $record->treatment }}</td>
                    <td>{{ $record->treatment_date }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('medical-records.edit', $record->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('medical-records.destroy', $record->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this record?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No medical records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/employee.css') }}">
@endsection