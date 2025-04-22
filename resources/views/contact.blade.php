<!-- init_set('display_errors', 1);
init_set('display_startup_errors');
error_reporting(E_ALL); -->
@extends('layouts.user.layout')

@section('title', 'Contact Us - Zoo Management System')

@section('content')
<section class="contact">
    <div>
    <h2 class="events-heading">Contact us </h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="wrapper">
        <div class="contact-grid">
            <!-- Left Column -->
            <div class="info-column">
                <!-- Address Block -->
                <div class="info-block">
                    <div class="icon-circle">
                        <i class="pe-7s-map-2"></i>
                    </div>
                    <h5 class="title">Address</h5>
                    <p>Entebbe, Uganda</p>
                </div>
                
                <!-- Call Center Block -->
                <div class="info-block">
                    <div class="icon-circle">
                        <i class="pe-7s-phone"></i>
                    </div>
                    <h5 class="title">Call center</h5>
                    <p>If you have any inquiries and would like to hear from us, feel free to reach out.</p>
                    <p class="phone">+256 414 320 520</p>
                </div>
                
                <!-- Email Block -->
                <div class="info-block">
                    <div class="icon-circle">
                        <i class="pe-7s-mail-open"></i>
                    </div>
                    <h5 class="title">Electronic support</h5>
                    <p>Please feel free to write an email to us or to use our electronic ticketing system.</p>
                    <ul>
                        <li><a href="#" class="email">info@zoomanagement.com</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Form Column -->
            <div class="form-column">
                <div class="form-block">
                    <div class="icon-circle">
                        <i class="pe-7s-pen"></i>
                    </div>
                    <h5 class="title">Contact Us</h5>
                    <p>If you have any inquiries and would like to hear from us, feel free to reach out using the form below.</p>
       
                    <form id="contact-form" method="POST" action="{{route('contact.submit')}}">
                        @csrf
                       
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required="">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input id="subject" type="text" name="subject" value="{{ old('subject') }}"required="">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" rows="5" name="comment" value= "{{ old('comment') }}" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating (1-5)</label>
                            <!-- <textarea id="rating" rows="5" name="rating" required=""></textarea> -->
                            <select id="rating" name="rating" required>
                                <option value="" {{ old('rating') ? '' : 'selected' }}>Select Rating</option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            @error('rating')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="send-btn" name="submit">
                                <i class="pe-7s-mail"></i> SEND MESSAGE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="map-container">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7438101579443!2d32.5386032!3d0.0588342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177d987a0d6b68ad%3A0xd5f0aec1ccac03df!2sUganda%20Wildlife%20Education%20Centre!5e0!3m2!1sen!2sus!4v1713472552987!5m2!1sen!2sus" 
        width="100%" 
        height="450" 
        allowfullscreen="" 
        loading="lazy">
    </iframe>
</div>

@push('styles')
<style>
   
   * Base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.5;
    color: #333;
}

.events-heading {
        margin-bottom: 20px;
        position: relative;
        font-size: 24px;
    }

/* .events-heading::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -10px;
    width: 30%;
    height: 1px;
    background-color:  #4CAF50;
} */

/* Contact section */
.contact {
    padding: 20;
    background-color: #fff;
    margin-top: 60px;
    
}

.wrapper {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
}

/* Info column */
.info-column {
    flex: 1;
    min-width: 280px;
}

/* Form column */
.form-column {
    flex: 2;
    min-width: 280px;
}

/* Common block styling */
.info-block, .form-block {
    margin-bottom: 2.5rem;
}

.icon-circle {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 1px solid #4CAF50;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.icon-circle i {
    font-size: 1.75rem;
    color: #4CAF50;
}

.title {
    position: relative;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.title:after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 30px;
    height: 2px;
    background-color: #4CAF50;
}

p {
    color: #6c757d;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.phone {
    font-size: 1.1rem;
    font-weight: 500;
    color: #333;
}

ul {
    list-style: none;
    padding-left: 0;
}

a.email {
    color: #4CAF50;
    text-decoration: none;
    font-weight: 500;
}

a.email:hover {
    text-decoration: underline;
}

/* Form styles */
.form-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
    width: 100%;
}

.form-group.half {
    flex: 1;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

input, textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 2px;
    font-family: inherit;
    font-size: 1rem;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

.send-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: transparent;
    color: #4CAF50;
    border: 1px solid #4CAF50;
    border-radius: 2px;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.send-btn:hover {
    background: #4CAF50;
    color: white;
}

.send-btn i {
    margin-right: 0.5rem;
}

.map-container {
    padding: 10px;
    margin: 20px 0;
    border: 1px solid #ddd;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .contact-grid {
        flex-direction: column;
    }

}
.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
}
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
</style>

<!-- PE-icon-7-stroke library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">


@endpush

