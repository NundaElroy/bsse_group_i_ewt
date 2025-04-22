@extends('layouts.admin.layout')

@section('title', 'Add Medical Record')

@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Add Medical Record</h2>
            <p class="employee-subtitle">Fill in the medical record details below</p>
        </div>

        <form action="{{ route('medical-records.store') }}" method="POST">
            @csrf

            <div class="employee-form-group">
                <label for="animal_id">Animal</label>
                <select name="animal_id" required>
                    @foreach($animals as $animal)
                        <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                    @endforeach
                </select>
                @error('animal_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="diagnosis">Diagnosis</label>
                <input type="text" name="diagnosis" required>
                @error('diagnosis')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="treatment">Treatment</label>
                <textarea name="treatment" rows="3" required></textarea>
                @error('treatment')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="treatment_date">Treatment Date</label>
                <input type="date" name="treatment_date" required>
                @error('treatment_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="record_date">Record Date</label>
                <input type="date" name="record_date" id="record_date" required>
                @error('record_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-group">
                <label for="procedure_type">Procedure Type</label>
                <input type="text" name="procedure_type" required>
                @error('procedure_type')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="employee-form-buttons">
                <button type="submit">Save Record</button>
                <a href="{{ route('medical-records.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection