@extends('layouts.admin.layout')

@section('title', 'Animals List')

@section('content')
<div class="container">
    <h2>Animals List</h2>
    <a href="{{ route('animals.create') }}" class="btn btn-primary mb-3">Add New Animal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Species</th>
                <th>Age</th>
                <th>Habitat</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($animals as $animal)
            <tr>
                <td>{{ $animal->name }}</td>
                <td>{{ $animal->species }}</td>
                <td>{{ $animal->age }}</td>
               <td>{{ $animal->habitat ? $animal->habitat->name : 'No Habitat' }}</td>

                <td>
                    @if($animal->image)
                        <img src="{{ asset('storage/' . $animal->image) }}" width="60" alt="Animal">
                    @else
                        No image
                    @endif
                </td>
                <td>
                    <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this animal?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
