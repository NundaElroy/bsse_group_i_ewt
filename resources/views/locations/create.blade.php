@extends('layouts.admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Add New Location</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf

            @include('locations._form', ['location' => new \App\Models\Location])

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Location</button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
