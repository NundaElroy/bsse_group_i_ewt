@extends('layouts.user.layout')

@section('title', 'Book Zoo Tickets')

@section('styles')
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/tickets.css') }}">
@endsection

@section('content')
<div class="ticket-booking-container">
    <div class="ticket-booking-card">
        <h2>Book Your Uganda Wildlife Education Centre Tickets</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

                    <div class="ticket-price-list">
                @foreach ($ticketTypes as $category => $tickets)
                    <div class="ticket-price-category">
                        <h3>{{ $category }}</h3>

                        @foreach ($tickets as $ticket)
                            <div class="ticket-price">
                                <span>{{ $ticket->age_category }}</span>
                                <span>UGX {{ number_format($ticket->price) }}</span>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>


        <form action="{{ route('book_ticket') }}" method="POST" class="ticket-form" id="ticketForm">
            @csrf

            <div class="form-group">
                <label for="visitor_type">Visitor Type</label>
                <select name="visitor_type" id="visitor_type" required>
                    <option value="citizen">Ugandan Citizen</option>
                    <option value="foreign">Foreign Visitor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter your address">
            </div>

            <div class="form-group">
                <label for="document_type">Document Type</label>
                <select name="document_type" id="document_type" required>
                    <option value="national_id">National ID</option>
                    <option value="passport">Passport</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_number">National ID / Passport Number</label>
                <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}" placeholder="Enter National ID or Passport Number" required>
                <div id="id_error" style="color: red; display: none;">Invalid ID/Passport format.</div>
            </div>

            <div class="form-group">
                <label for="adult">Number of Adult Tickets</label>
                <input type="number" name="adult" id="adult" value="{{ old('adult', 0) }}" min="0" required>
            </div>

            <div class="form-group">
                <label for="child">Number of Child Tickets</label>
                <input type="number" name="child" id="child" value="{{ old('child', 0) }}" min="0" required>
            </div>

            <div class="form-group">
                <label for="date">Visit Date</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" required>
            </div>

            <div class="form-group payment-container">
                <div class="total-amount">
                    <label for="total_amount">Total Amount</label>
                    <input type="text" name="total_amount" id="total_amount" value="UGX 0" readonly style="text-transform: uppercase;" class="readonly-field">
                </div>

                <div class="payment-method">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="cash">Cash</option>
                        <option value="mobile_money">Mobile Money</option>
                        <option value="card">Credit/Debit Card</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="comments">Special Requests / Comments</label>
                <textarea name="comments" id="comments" placeholder="Any special requests or additional information" rows="3">{{ old('comments') }}</textarea>
            </div>

            <button type="submit" class="btn-book-ticket">Book Ticket</button>
        </form>
    </div>
</div>

<!-- Link to external JS file -->
<script src="{{ asset('js/tickets.js') }}"></script>
@endsection
