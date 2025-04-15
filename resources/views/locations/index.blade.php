@extends('layouts.admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">List of Locations</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Location</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Location Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->description ?? '-' }}</td>
                    <td>{{ $location->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <a href="{{ route('locations.edit', $location) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this location?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No locations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
