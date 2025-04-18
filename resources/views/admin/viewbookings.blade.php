@extends('layouts.admin.layout')

@section('title', 'Bookings')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Bookings</h2>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table"  id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Visitor Name</th>
                    <th>Visit Date</th>
                    <th>Adults</th>
                    <th>Children</th>
                    <th>Total Amount (UGX)</th>
                    <th>Payment Method</th>
                    <th>Special Requests</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->visitor->full_name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->visit_date)->format('M d, Y') }}</td>
                        <td>{{ $booking->adult_tickets }}</td>
                        <td>{{ $booking->child_tickets }}</td>
                        <td>UGX {{ number_format($booking->total_amount) }}</td>
                        <td>{{ ucfirst($booking->payment_method) }}</td>
                        <td>{{ $booking->special_requests ?? 'None' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection