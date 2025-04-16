@extends('layouts.admin.layout')

@section('title', 'Location Management')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Location Management</h2>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Location</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table">
            <thead>
                <tr>
                    <th>Location Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->description ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($location->created_at)->format('M d, Y') }}</td>
                        <td class="actions">
                            <a href="{{ route('locations.edit', $location) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('locations.destroy', $location) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No locations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
