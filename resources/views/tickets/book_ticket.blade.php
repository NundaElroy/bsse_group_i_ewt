@extends('layouts.user.layout')

@section('title', 'Book Zoo Tickets')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/styl.css') }}">
@endsection

@section('content')
<div class="ticket-booking-container">
    <div class="ticket-booking-header">
        <h1>Book Your Visit</h1>
        <p>Experience wildlife up-close at Sebabe Conservation Centre</p>
    </div>
    
    <div class="ticket-booking-content">
        <div class="ticket-info-panel">
            <div class="ticket-info-header">
                <h2>Ticket Information</h2>
                <div class="ticket-info-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            
            <div class="ticket-price-list">
                
            @foreach ($ticketTypes as $category => $tickets)
                <div class="ticket-price-category">
                    <h3>{{ $category }}</h3>
                    <div class="ticket-price-items">
                        @foreach ($tickets as $ticket)
                            <div class="ticket-price-item" 
                                data-category="{{ strtolower(str_replace(' ', '_', $category)) }}"
                                data-age="{{ strtolower(str_replace(' ', '_', $ticket->age_category)) }}"
                                data-price="{{ $ticket->price }}">
                                <div class="ticket-type">{{ $ticket->age_category }}</div>
                                <div class="ticket-price">UGX {{ number_format($ticket->price) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
            
            <div class="ticket-benefits">
                <h3>Benefits Include:</h3>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Full-day access to all animal exhibits</li>
                    <li><i class="fas fa-check-circle"></i> Educational wildlife presentations</li>
                    <li><i class="fas fa-check-circle"></i> Free parking for visitors</li>
                    <li><i class="fas fa-check-circle"></i> Access to picnic and rest areas</li>
                </ul>
            </div>
        </div>

        <div class="ticket-booking-form-container">
            <h2>Booking Details</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="alert-content">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif 
            
            @if ($errors->has('general'))
                <div class="alert alert-danger">
                    <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="alert-content">{{ $errors->first('general') }}</div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="alert-content">{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('book_ticket.store') }}" method="POST" class="ticket-form" id="ticketForm">
                @csrf
                
                <div class="form-section">
                    <h3>Visitor Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="visitor_type">Visitor Type <span class="required">*</span></label>
                            <select name="visitor_type" id="visitor_type" required>
                                <option value="Ugandan Citizen" {{ old('visitor_type') == 'Ugandan Citizen' ? 'selected' : '' }}>Ugandan Citizen</option>
                                <option value="Foreign Visitor" {{ old('visitor_type') == 'Foreign Visitor' ? 'selected' : '' }}>Foreign Visitor</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter your address">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="document_type">Document Type <span class="required">*</span></label>
                            <select name="document_type" id="document_type" required>
                                <option value="national_id" {{ old('document_type') == 'national_id' ? 'selected' : '' }}>National ID</option>
                                <option value="passport" {{ old('document_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="id_number">ID/Passport Number <span class="required">*</span></label>
                            <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}" placeholder="Enter National ID or Passport Number" required>
                            <div id="id_error" class="input-error">Invalid ID/Passport format.</div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3>Booking Details</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="date">Visit Date <span class="required">*</span></label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="payment_method">Payment Method <span class="required">*</span></label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row ticket-quantities">
                        <div class="form-group">
                            <label for="adult">Adult Tickets <span class="required">*</span></label>
                            <div class="quantity-input">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" name="adult" id="adult" value="{{ old('adult', 0) }}" min="0" required>
                                <button type="button" class="quantity-btn plus">+</button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="child">Child Tickets <span class="required">*</span></label>
                            <div class="quantity-input">
                                <button type="button" class="quantity-btn minus">-</button>
                                <input type="number" name="child" id="child" value="{{ old('child', 0) }}" min="0" required>
                                <button type="button" class="quantity-btn plus">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="comments">Special Requests / Comments</label>
                        <textarea name="comments" id="comments" placeholder="Any special requests or additional information" rows="3">{{ old('comments') }}</textarea>
                    </div>
                </div>

                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-items">
                        <div class="summary-item" id="adult-summary">
                            <span class="summary-label">Adult Tickets (x<span id="adult-count">0</span>)</span>
                            <span class="summary-value" id="adult-total">UGX 0</span>
                        </div>
                        <div class="summary-item" id="child-sum">
                            <span class="summary-label">Child Tickets (x<span id="child-count">0</span>)</span>
                            <span class="summary-value" id="child-summary">UGX 0</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-item summary-total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value" id="summary-total">UGX 0</span>
                        </div>
                    </div>
                    
                    <input type="hidden" name="total_amount" id="total_amount" value="0">
                    
                    <button type="submit" class="btn-book-ticket">
                        <i class="fas fa-ticket-alt"></i>
                        Complete Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/tickets.js') }}"></script>


@endsection

@push('styles')
<style>
    /* Additional inline styles to enhance the form */
    .ticket-booking-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
    }
    
    .ticket-booking-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .ticket-booking-header h1 {
        font-size: 36px;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .ticket-booking-header p {
        font-size: 18px;
        color: #7f8c8d;
    }
    
    .ticket-booking-content {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }
    
    /* Ticket Info Panel */
    .ticket-info-panel {
        flex: 1;
        min-width: 400px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        top: 20px;
        align-self: flex-start;
    }
    
    .ticket-info-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ecf0f1;
    }
    
    .ticket-info-header h2 {
        font-size: 24px;
        color: #34495e;
        margin: 0;
    }
    
    .ticket-info-icon {
        width: 40px;
        height: 40px;
        background-color: #27ae60;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .ticket-info-icon i {
        color: white;
        font-size: 20px;
    }
    
    .ticket-price-category {
        margin-bottom: 20px;
    }
    
    .ticket-price-category h3 {
        font-size: 18px;
        color: #2c3e50;
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dashed #ecf0f1;
    }
    
    .ticket-price-items {
        padding-left: 10px;
    }
    
    .ticket-price-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
    }
    
    .ticket-type {
        font-size: 15px;
        color: #555;
    }
    
    .ticket-price {
        font-weight: bold;
        color: #27ae60;
    }
    
    .ticket-benefits {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }
    
    .ticket-benefits h3 {
        font-size: 18px;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .ticket-benefits ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .ticket-benefits li {
        padding: 6px 0;
        font-size: 14px;
        color: #555;
    }
    
    .ticket-benefits li i {
        color: #27ae60;
        margin-right: 8px;
    }
    
    /* Form Container */
    .ticket-booking-form-container {
        flex: 2;
        min-width: 500px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
    
    .ticket-booking-form-container h2 {
        font-size: 24px;
        color: #34495e;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ecf0f1;
    }
    
    /* Alerts */
    .alert {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    
    .alert-danger {
        background-color: #fef1f2;
        border-left: 4px solid #e74c3c;
    }
    
    .alert-success {
        background-color: #edfbf3;
        border-left: 4px solid #27ae60;
    }
    
    .alert-icon {
        margin-right: 10px;
        font-size: 18px;
    }
    
    .alert-danger .alert-icon i {
        color: #e74c3c;
    }
    
    .alert-success .alert-icon i {
        color: #27ae60;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .alert-content ul {
        margin: 0;
        padding-left: 20px;
    }
    
    /* Form Sections */
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #ecf0f1;
    }
    
    .form-section h3 {
        font-size: 20px;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    
    .form-group {
        flex: 1;
    }
    
    .full-width {
        width: 100%;
    }
    
    label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        color: #34495e;
        font-weight: 500;
    }
    
    .required {
        color: #e74c3c;
    }
    
    input, select, textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dcdfe6;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s;
    }
    
    input:focus, select:focus, textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }
    
    .input-error {
        display: none;
        font-size: 12px;
        color: #e74c3c;
        margin-top: 5px;
    }
    
    /* Quantity Inputs */
    .quantity-input {
        display: flex;
        align-items: center;
        border: 1px solid #dcdfe6;
        border-radius: 6px;
        overflow: hidden;
    }
    
    .quantity-btn {
        width: 40px;
        height: 42px;
        background-color: #f8f9fa;
        border: none;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }
    
    .quantity-btn:hover {
        background-color: #e9ecef;
    }
    
    .quantity-input input {
        width: 60px;
        text-align: center;
        border: none;
        padding: 10px 0;
        font-size: 16px;
        font-weight: 500;
    }
    
    /* Order Summary */
    .order-summary {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }
    
    .order-summary h3 {
        font-size: 20px;
        color: #2c3e50;
        margin-bottom: 15px;
    }
    
    .summary-items {
        margin-bottom: 20px;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 15px;
        color: #555;
    }
    
    .summary-divider {
        border-top: 1px dashed #dcdfe6;
        margin: 10px 0;
    }
    
    .summary-total {
        font-weight: bold;
        font-size: 18px;
        color: #34495e;
    }
    
    .btn-book-ticket {
        width: 100%;
        padding: 14px 20px;
        background-color: #27ae60;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s;
    }
    
    .btn-book-ticket:hover {
        background-color: #219653;
    }
    
    .btn-book-ticket i {
        margin-right: 8px;
    }
    
    /* Responsive styles */
    @media (max-width: 992px) {
        .ticket-booking-content {
            flex-direction: column;
        }
        
        .ticket-info-panel {
            position: static;
            min-width: 100%;
        }
        
        .ticket-booking-form-container {
            min-width: 100%;
        }
    }
    
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 15px;
        }
        
        .ticket-booking-header h1 {
            font-size: 28px;
        }
        
        .ticket-booking-header p {
            font-size: 16px;
        }
    }
</style>
@endpush