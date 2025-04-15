@extends('layouts.admin.layout')
@section('title', 'editTicket')

@section('content')


<h2>Edit Ticket</h2>


@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif


<form method="POST" action="{{ route('updateTicket', $ticket->id) }}">
  @csrf

  <p>
    <label>
      Name:<br>
      <input type="text" name="name" value="{{ old('name', $ticket->name ?? '') }}" required>
    </label>
  </p>

  <p>
    <label>
      Visitor Category:<br>
      <select name="visitor_category" required>
        <option value="">-- Select --</option>
        <option value="Ugandan Citizen" {{ old('visitor_category', $ticket->visitor_category ?? '') == 'Ugandan Citizen' ? 'selected' : '' }}>Ugandan Citizen</option>
        <option value="Foreign Visitor" {{ old('visitor_category', $ticket->visitor_category ?? '') == 'Foreign Visitor' ? 'selected' : '' }}>Foreign Visitor</option>
      </select>
    </label>
  </p>

  <p>
    <label>
      Age Category:<br>
      <select name="age_category" required>
        <option value="">-- Select --</option>
        <option value="Adult" {{ old('age_category', $ticket->age_category ?? '') == 'Adult' ? 'selected' : '' }}>Adult</option>
        <option value="Child" {{ old('age_category', $ticket->age_category ?? '') == 'Child' ? 'selected' : '' }}>Child</option>
      </select>
    </label>
  </p>

  <p>
    <label>
      Price (UGX):<br>
      <input type="number" name="price" value="{{ old('price', $ticket->price ?? '') }}" required>
    </label>
  </p>

  <p>
    <button type="submit">Save Ticket Type</button>
  </p>
</form>


@endsection

@push('styles')
<style>
  h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

  form {
    max-width: 400px;
    margin: 20px auto;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    font-family: Arial, sans-serif;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  form p {
    margin-bottom: 15px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="number"],
  select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  button[type="submit"] {
    padding: 10px 16px;
    background-color: #3b82f6;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #2563eb;
  }
</style>
@endpush
