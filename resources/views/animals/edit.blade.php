@extends('layouts.admin.layout')

@section('title', 'Edit Animal')

@section('content')
<div class="container">
    <h2>Edit Animal</h2>

    <form action="{{ route('animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Animal Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $animal->name }}" required>
        </div>

        <div class="form-group">
            <label for="species">Species:</label>
            <input type="text" name="species" class="form-control" value="{{ $animal->species }}" required>
        </div>

        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" name="age" class="form-control" value="{{ $animal->age }}" required>
        </div>

        <div class="form-group">
            <label for="habitat_id">Habitat:</label>
            <select name="habitat_id" class="form-control" required>
                @foreach($habitats as $habitat)
                    <option value="{{ $habitat->id }}" {{ $animal->habitat_id == $habitat->id ? 'selected' : '' }}>
                        {{ $habitat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Animal Image:</label>
            <input type="file" name="image" class="form-control-file">
            @if ($animal->image)
                <img src="{{ asset('storage/' . $animal->image) }}" alt="Animal Image" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Animal</button>
    </form>
</div>
@endsection
