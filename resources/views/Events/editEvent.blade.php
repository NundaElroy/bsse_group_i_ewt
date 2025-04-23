@extends('layouts.admin.layout')

@section('title', 'Edit Event')
@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Edit Event</h2>
            <p class="employee-subtitle">Update the event details below</p>
        </div>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Name --}}
            <div class="employee-form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name', $event->name) }}" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Description --}}
            <div class="employee-form-group">
                <label for="description">Description</label>
                <textarea name="description">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Location --}}
            <div class="employee-form-group">
                <label for="location">Location</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}" required>
                @error('location')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Start Time --}}
            <div class="employee-form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time', date('Y-m-d\TH:i', strtotime($event->start_time))) }}" required>
                @error('start_time')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- End Time --}}
            <div class="employee-form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time', date('Y-m-d\TH:i', strtotime($event->end_time))) }}" required>
                @error('end_time')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Status --}}
            <div class="employee-form-group">
                <label for="status">Status</label>
                <select name="status">
                    <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="past" {{ old('status', $event->status) == 'past' ? 'selected' : '' }}>Past</option>
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
                        <option value="{{ $employee->id }}" {{ old('employee_id', $event->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Current Image --}}
            @if($event->image_path)
            <div class="employee-form-group">
                <label>Current Image</label>
                <div class="current-image">
                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" style="max-width: 200px; margin-bottom: 10px;">
                </div>
            </div>
            @endif
            
            {{-- Event Image --}}
            <div class="employee-form-group">
                <label for="image">New Event Image (leave empty to keep current)</label>
                <input type="file" name="image">
                @error('image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Submit --}}
            <div class="employee-form-buttons">
                <button type="submit">Update Event</button>
                <a href="{{ route('events.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection