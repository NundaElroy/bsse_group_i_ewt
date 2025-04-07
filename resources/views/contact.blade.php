@extends('layouts.user.layout')

@section('title', 'Contact Us - Zoo Management System')

@section('content')
<!-- <h1>Contact Us</h1> -->
<div class="container" style="max-width: 600px; margin-top: 30px;">
    <h1>Contact Us</h1>
    <!--placeholder # for submission-->
    <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf <!-- For security if you later submit to a route -->

        <div>
            <label for="first_name">First Name</label><br>
            <input type="text" id="first_name" name="first_name" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div>
            <label for="last_name">Last Name</label><br>
            <input type="text" id="last_name" name="last_name" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <div>
            <label for="message">Message</label><br>
            <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
        </div>

        <button type="submit" style="background-color: #2e7d32; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
            Send Message
        </button>
    </form>
</div>


    <div class="container">
        
         <p>If you have any inquiries and would like to hear from us, feel free to also reach out using the information below.</p>
        <ul>
            <li>Email: info@zoomanagement.com</li>
            <li>Phone: +256 414 320 520</li>
            <li>Address: Entebbe, Uganda</li>
        </ul>
    </div>
@endsection
