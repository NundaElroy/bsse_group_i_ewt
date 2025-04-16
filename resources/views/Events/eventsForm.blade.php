@extends('layouts.admin.layout')

@section('title', 'Add Event')
@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Create Event</h2>
            <p class="employee-subtitle">Fill in the event details below</p>
        </div>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Name --}}
            <div class="employee-form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Description --}}
            <div class="employee-form-group">
                <label for="description">Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Location --}}
            <div class="employee-form-group">
                <label for="location">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Start Time --}}
            <div class="employee-form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time') }}" required>
                @error('start_time')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- End Time --}}
            <div class="employee-form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time') }}" required>
                @error('end_time')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Status --}}
            <div class="employee-form-group">
                <label for="status">Status</label>
                <select name="status">
                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="past" {{ old('status') == 'past' ? 'selected' : '' }}>Past</option>
                </select>
                @error('status')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Employee --}}
            <div class="employee-form-group">
                <label for="employee_id">Employee</label>
                <select name="employee_id" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Event Image --}}
            <div class="employee-form-group">
                <label for="image">Event Image</label>
                <input type="file" name="image">
                @error('image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Submit --}}
            <div class="employee-form-buttons">
                <button type="submit">Save Event</button>
                <a href="{{ route('events.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection