@extends('layouts.admin.layout')

@section('title', 'Animals List')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Animals List</h2>
        <a href="{{ route('animals.create') }}" class="btn btn-primary">Add New Animal</a>
    </div>

    @if(session('success'))
    <div style="padding: 12px 20px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724; background-color: #d4edda; font-family: system-ui, -apple-system, sans-serif;">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Location</th>
                    <th>Acquisition Date</th>
                    <th>Date of Birth</th>
                    <th>ID Number</th>
                    <th>Origin</th>
                    <th>Diet</th>
                    <th>Medical History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($animals as $animal)
                <tr>
                    <td>
                        @if($animal->image)
                            <img src="{{ asset('storage/' . $animal->image) }}" style="width: 80px;" alt="Animal">
                        @else
                            No image
                        @endif
                    </td>
                    <td>{{ $animal->name }}</td>
                    <td>{{ $animal->species }}</td>
                    <td>{{ $animal->age }}</td>
                    <td>{{ ucfirst($animal->gender) }}</td>
                    <td>{{ $animal->habitat ? $animal->habitat->name : 'No Location' }}</td>
                    <td>{{ $animal->acquisition_date }}</td>
                    <td>{{ $animal->date_of_birth ?? 'N/A' }}</td>
                    <td>{{ $animal->identification_number ?? 'N/A' }}</td>
                    <td>{{ $animal->origin ?? 'N/A' }}</td>
                    <td>{{ $animal->dietary_requirements ?? 'N/A' }}</td>
                    <td>{{ $animal->medical_history ?? 'N/A' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('animals.edit', $animal->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this animal?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13">No animals found.</td>
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
