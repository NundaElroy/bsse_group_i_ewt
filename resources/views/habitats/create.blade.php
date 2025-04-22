@extends('layouts.admin.layout')

{{-- resources/views/habitats/create.blade.php --}}


@section('title', 'Create Habitat')

@section('content')
    <div class="container">
        <h1>Create Habitat</h1>
        
        <form action="{{ route('habitats.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Habitat Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Habitat</button>
            </div>
        </form>
    </div>
@endsection
