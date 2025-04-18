@extends('layouts.admin.layout')

@section('title', 'Tickets')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <div class="employee-title-group">
            <h2>Ticket Types</h2>
            <div class="employee-subtitle">Manage available visitor tickets</div>
        </div>
       
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Visitor Category</th>
                    <th>Age Category</th>
                    <th>Price (UGX)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ticketTypes as $ticket)
                    <tr>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->visitor_category }}</td>
                        <td>{{ $ticket->age_category }}</td>
                        <td>{{ number_format($ticket->price) }}</td>
                        <td class="actions">
                            <a href="{{ route('editTicket', $ticket->id) }}" class="btn-edit">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="no-data">No ticket types available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection




