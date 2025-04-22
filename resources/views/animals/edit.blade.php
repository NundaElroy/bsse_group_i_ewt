@extends('layouts.admin.layout')

@section('title', 'Edit Animal')

@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Edit Animal</h2>
            <p class="employee-subtitle">Update the animal details below</p>
        </div>

        <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="employee-form-group">
                <label for="name">Animal Name:</label>
                <input type="text" name="name" value="{{ old('name', $animal->name) }}" required>
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Species --}}
            <div class="employee-form-group">
                <label for="species">Species:</label>
                <input type="text" name="species" value="{{ old('species', $animal->species) }}" required>
                @error('species') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Age --}}
            <div class="employee-form-group">
                <label for="age">Age:</label>
                <input type="number" name="age" value="{{ old('age', $animal->age) }}" required>
                @error('age') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Gender --}}
            <div class="employee-form-group">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="male" {{ old('gender', $animal->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $animal->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender', $animal->gender) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Location --}}
            <div class="employee-form-group">
                <label for="location_id">Location:</label>
                <select name="location_id" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $animal->location_id) == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Acquisition Date --}}
            <div class="employee-form-group">
                <label for="acquisition_date">Acquisition Date:</label>
                <input type="date" name="acquisition_date" value="{{ old('acquisition_date', $animal->acquisition_date ? $animal->acquisition_date->format('Y-m-d') : '') }}" required>
                @error('acquisition_date') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="employee-form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $animal->date_of_birth ? $animal->date_of_birth->format('Y-m-d') : '') }}">
                @error('date_of_birth') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Identification Number --}}
            <div class="employee-form-group">
                <label for="identification_number">Identification Number:</label>
                <input type="text" name="identification_number" value="{{ old('identification_number', $animal->identification_number) }}">
                @error('identification_number') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Origin --}}
            <div class="employee-form-group">
                <label for="origin">Origin:</label>
                <input type="text" name="origin" value="{{ old('origin', $animal->origin) }}">
                @error('origin') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Dietary Requirements --}}
            <div class="employee-form-group">
                <label for="dietary_requirements">Dietary Requirements:</label>
                <input type="text" name="dietary_requirements" value="{{ old('dietary_requirements', $animal->dietary_requirements) }}">
                @error('dietary_requirements') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Medical History --}}
            <div class="employee-form-group">
                <label for="medical_history">Medical History:</label>
                <input type="text" name="medical_history" value="{{ old('medical_history', $animal->medical_history) }}">
                @error('medical_history') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Image --}}
            <div class="employee-form-group">
                <label for="image">Animal Image:</label>
                <input type="file" name="image">
                @if ($animal->image)
                    <div class="existing-image">
                        <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" width="100">
                    </div>
                @endif
                @error('image') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Submit Buttons --}}
            <div class="employee-form-buttons">
                <button type="submit">Update Animal</button>
                <a href="{{ route('animals.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
