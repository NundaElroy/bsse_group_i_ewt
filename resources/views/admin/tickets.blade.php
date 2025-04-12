@extends('layouts.admin.layout')

@section('title', 'tickets')

@section('content')
<div class="ticket-types-container">
    <h2>Ticket Types</h2>

    <table class="ticket-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Visitor Category</th>
                <th>Age Category</th>
                <th>Price (UGX)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketTypes as $ticket)
                <tr>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->visitor_category }}</td>
                    <td>{{ $ticket->age_category }}</td>
                    <td>{{ number_format($ticket->price) }}</td>
                    <td><a href="#" class="edit-btn">Edit</a></td>
                </tr>
            @endforeach
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
        min-width: 600px; /* ensures table doesn't shrink too much on mobile */
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

