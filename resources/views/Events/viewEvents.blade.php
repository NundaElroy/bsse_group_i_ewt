@extends('layouts.admin.layout')

@section('title', 'Events')
@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>All Events</h2>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Employee</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end_time)->format('M d, Y H:i') }}</td>
                        <td>{{ $event->employee->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($event->status) }}</td>
                        <td>
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" width="80" alt="{{ $event->name }}">
                            @else
                                No Image
                            @endif
                        </td>
                        <td >
                           <div class="actions">
                           <a href="{{ route('events.edit', $event) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                           </div>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No events found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection