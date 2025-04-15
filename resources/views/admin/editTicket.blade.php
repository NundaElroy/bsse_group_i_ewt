@extends('layouts.admin.layout')

@section('title', 'Edit Ticket')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Edit Ticket</h2>
        <a href="{{ route('tickets') }}" class="btn btn-primary">Back to Tickets</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="employee-form-container">
        <form method="POST" action="{{ route('updateTicket', $ticket->id) }}">
            @csrf

            <div class="employee-form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{ old('name', $ticket->name ?? '') }}" required>
            </div>

            <div class="employee-form-group">
                <label>Visitor Category:</label>
                <select name="visitor_category" required>
                    <option value="">-- Select --</option>
                    <option value="Ugandan Citizen" {{ old('visitor_category', $ticket->visitor_category ?? '') == 'Ugandan Citizen' ? 'selected' : '' }}>Ugandan Citizen</option>
                    <option value="Foreign Visitor" {{ old('visitor_category', $ticket->visitor_category ?? '') == 'Foreign Visitor' ? 'selected' : '' }}>Foreign Visitor</option>
                </select>
            </div>

            <div class="employee-form-group">
                <label>Age Category:</label>
                <select name="age_category" required>
                    <option value="">-- Select --</option>
                    <option value="Adult" {{ old('age_category', $ticket->age_category ?? '') == 'Adult' ? 'selected' : '' }}>Adult</option>
                    <option value="Child" {{ old('age_category', $ticket->age_category ?? '') == 'Child' ? 'selected' : '' }}>Child</option>
                </select>
            </div>

            <div class="employee-form-group">
                <label>Price (UGX):</label>
                <input type="number" name="price" value="{{ old('price', $ticket->price ?? '') }}" required>
            </div>

            <div class="employee-form-buttons">
                <button type="submit">Save Ticket Type</button>
                <a href="{{ route('tickets') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- @section('styles')
<link rel="stylesheet" href="{{ asset('css/employee.css') }}">
@endsection -->
