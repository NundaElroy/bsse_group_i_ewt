@extends('layouts.admin.layout')

@section('title', 'bookings')

@section('content')
<div class="ticket-types-container">
    <h2>Bookings</h2>

    <table class="ticket-table">
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
                    <td>{{ \Carbon\Carbon::parse($booking->visit_date)->format('Y-m-d') }}</td>
                    <td>{{ $booking->adult_tickets }}</td>
                    <td>{{ $booking->child_tickets }}</td>
                    <td>{{ number_format($booking->total_amount) }}</td>
                    <td>{{ $booking->payment_method }}</td>
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



@endsection

@push('styles')
<style>
    .ticket-types-container {
        padding: 20px;
        max-width: 100%;
        overflow-x: auto;
    }

    .ticket-types-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .ticket-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        min-width: 700px; /* ensures table doesn't shrink too much on mobile */
    }

    .ticket-table th,
    .ticket-table td {
        padding: 12px 10px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 15px;
    }

    .ticket-table thead {
        background-color: #4CAF50;
        color: white;
    }

    .ticket-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .ticket-table tbody tr:hover {
        background-color: #e0f7e9;
    }

    .edit-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #2196F3;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    .edit-btn:hover {
        background-color: #1976D2;
    }

    /* Mobile responsiveness */
    @media screen and (max-width: 600px) {
        .ticket-types-container {
            padding: 10px;
        }

        .ticket-table {
            font-size: 14px;
            min-width: 100%;
        }

        .edit-btn {
            padding: 6px 12px;
            font-size: 13px;
        }
    }
</style>
@endpush


