@extends('layouts.admin.layout')

@section('title', 'Add New Animal')

@section('content')
<div class="container">
    <h2>Add New Animal</h2>

    <form action="{{ route('animals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Animal Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="species">Species:</label>
            <input type="text" name="species" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="habitat_id">Habitat:</label>
            <select name="habitat_id" class="form-control" required>
                @foreach($habitats as $habitat)
                    <option value="{{ $habitat->id }}">{{ $habitat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Animal Image:</label>
            <input type="file" name="image" class="form-control-file">
        </div>
		<div class="form-group">
    <label for="location_id">Location</label>
    <select name="location_id" id="location_id" class="form-control" required>
        @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="acquisition_date">Acquisition Date</label>
    <input type="date" name="acquisition_date" class="form-control" required>
</div>


        <button type="submit" class="btn btn-primary">Add Animal</button>
    </form>
</div>
@endsection
