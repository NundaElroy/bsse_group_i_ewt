@extends('layouts.admin.layout')

@section('title', 'Add New Animal')



@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Add New Animal</h2>
            <p class="employee-subtitle">Fill in the animal details below</p>
        </div>

        <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="employee-form-group">
                <label for="name">Animal Name:</label>
                <input type="text" name="name" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="species">Species:</label>
                <input type="text" name="species" required>
                @error('species')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="age">Age:</label>
                <input type="number" name="age" required>
                @error('age')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="" disabled selected>Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unknown">Unknown</option>
                </select>
                @error('gender')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>


            <div class="employee-form-group">
                <label for="location_id">Location:</label>
                <select name="location_id" required>
                    @foreach($locations as $Location)
                        <option value="{{ $Location->id }}">{{ $Location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="image">Animal Image:</label>
                <input type="file" name="image">
                @error('image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="acquisition_date">Acquisition Date:</label>
                <input type="date" name="acquisition_date" required>
                @error('acquisition_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth">
                @error('date_of_birth')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="identification_number">Identification Number:</label>
                <input type="text" name="identification_number">
                @error('identification_number')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="origin">Origin:</label>
                <input type="text" name="origin">
                @error('origin')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="dietary_requirements">Dietary Requirements:</label>
                <input type="text" name="dietary_requirements">
                
                @error('dietary_requirements')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="medical_history">Medical History:</label>
                <input type="text" name="medical_history">
                
                @error('medical_history')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-buttons">
                <button type="submit">Add Animal</button>
                <a href="{{ route('animals.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
