@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <h1>Add Medical Record</h1>

    <form action="{{ route('medical-records.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="animal_id">Animal</label>
            <select name="animal_id" class="form-control" required>
                @foreach($animals as $animal)
                    <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="diagnosis">Diagnosis</label>
            <input type="text" name="diagnosis" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea name="treatment" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="treatment_date">Treatment Date</label>
            <input type="date" name="treatment_date" class="form-control" required>
        </div>
		<div class="form-group">
    <label for="record_date">Record Date</label>
    <input type="date" name="record_date" id="record_date" class="form-control" required>
      </div>
	  <!-- Add this to your medical record create form -->
<div class="form-group">
    <label for="procedure_type">Procedure Type</label>
    <input type="text" name="procedure_type" class="form-control" required>
</div>


        <button type="submit" class="btn btn-success mt-2">Save Record</button>
    </form>
</div>
@endsection
