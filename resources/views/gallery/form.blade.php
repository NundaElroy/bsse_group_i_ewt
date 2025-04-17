@extends('layouts.admin.layout')

@section('title', isset($gallery) ? 'Edit Gallery' : 'Add Gallery')

@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>{{ isset($gallery) ? 'Edit Gallery' : 'Upload image' }}</h2>
            <p class="employee-subtitle">Fill in the gallery details below</p>
        </div>

        <form action="{{ isset($gallery) ? route('galleries.update', $gallery->id) : route('galleries.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($gallery))
                @method('PUT')
            @endif

            {{-- Title --}}
            <div class="employee-form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title ?? '') }}" required>
                @error('title')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="employee-form-group">
                <label for="description">Description</label>
                <textarea name="description">{{ old('description', $gallery->description ?? '') }}</textarea>
                @error('description')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="employee-form-group">
                <label for="image">Image</label>
                <input type="file" name="image">
                @error('image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="employee-form-buttons">
                <button type="submit">{{ isset($gallery) ? 'Update Gallery' : 'Save Gallery' }}</button>
                <a href="{{ route('galleries.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
