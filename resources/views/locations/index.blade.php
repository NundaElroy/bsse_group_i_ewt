@extends('layouts.admin.layout')

@section('title', 'Location Management')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Location Management</h2>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Location</a>
    </div>
    
    @if(session('success'))
    <div style="padding: 12px 20px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724; background-color: #d4edda; font-family: system-ui, -apple-system, sans-serif;">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
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
                        <td >
                            <div class="actions">
                            <a href="{{ route('locations.edit', $location) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('locations.destroy', $location) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                            </form>
                            </div>
                            
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

@push('scripts')

<script>

    document.addEventListener("DOMContentLoaded", function() {
       
        const dataTable = new simpleDatatables.DataTable("#dataTable", {
            searchable: true,
            fixedHeight: true,
            perPage: 10,
            // Optional: customize labels
            labels: {
                placeholder: "Search...",
                perPage: "",
                info: "Showing {start} to {end} of {rows} entries",
            }
        });
        
      
    });
</script>

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endpush