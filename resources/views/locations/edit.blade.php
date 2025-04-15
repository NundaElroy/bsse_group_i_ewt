@extends('layouts.admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Location</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('locations.update', $location) }}" method="POST">
            @csrf
            @method('PUT')

            @include('locations._form')

            <div class="text-end">
                <button type="submit" class="btn btn-success">Update Location</button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
