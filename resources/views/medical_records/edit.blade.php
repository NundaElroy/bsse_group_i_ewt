@extends('layouts.admin.layout')

@section('title', 'Edit Medical Record')

@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Edit Medical Record</h2>
            <p class="employee-subtitle">Update the medical record details below</p>
        </div>

        <form action="{{ route('medical-records.update', $medicalRecord->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Animal --}}
            <div class="employee-form-group">
                <label for="animal_id">Animal:</label>
                <select name="animal_id" required>
                    @foreach($animals as $animal)
                        <option value="{{ $animal->id }}" {{ old('animal_id', $medicalRecord->animal_id) == $animal->id ? 'selected' : '' }}>
                            {{ $animal->name }}
                        </option>
                    @endforeach
                </select>
                @error('animal_id') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Diagnosis --}}
            <div class="employee-form-group">
                <label for="diagnosis">Diagnosis:</label>
                <input type="text" name="diagnosis" value="{{ old('diagnosis', $medicalRecord->diagnosis) }}" required>
                @error('diagnosis') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Treatment --}}
            <div class="employee-form-group">
                <label for="treatment">Treatment:</label>
                <textarea name="treatment" rows="3" required>{{ old('treatment', $medicalRecord->treatment) }}</textarea>
                @error('treatment') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Treatment Date --}}
            <div class="employee-form-group">
                <label for="treatment_date">Treatment Date:</label>
                <input type="date" name="treatment_date" value="{{ old('treatment_date', $medicalRecord->treatment_date ? $medicalRecord->treatment_date->format('Y-m-d') : '') }}" required>
                @error('treatment_date') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Submit Buttons --}}
            <div class="employee-form-buttons">
                <button type="submit">Update Record</button>
                <a href="{{ route('medical-records.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
