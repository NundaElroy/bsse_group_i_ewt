@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <h1>Edit Medical Record</h1>

    <form action="{{ route('medical-records.update', $medicalRecord->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="animal_id">Animal</label>
            <select name="animal_id" class="form-control" required>
                @foreach($animals as $animal)
                    <option value="{{ $animal->id }}" {{ $medicalRecord->animal_id == $animal->id ? 'selected' : '' }}>
                        {{ $animal->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="diagnosis">Diagnosis</label>
            <input type="text" name="diagnosis" class="form-control" value="{{ $medicalRecord->diagnosis }}" required>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" class="form-control" rows="3" required>{{ $medicalRecord->treatment }}</textarea>
        </div>

        <div class="form-group">
            <label for="treatment_date">Treatment Date</label>
            <input type="date" name="treatment_date" class="form-control" value="{{ $medicalRecord->treatment_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update Record</button>
    </form>
</div>
@endsection
