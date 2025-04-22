@extends('layouts.admin.layout')

{{-- resources/views/habitats/index.blade.php --}}


@section('title', 'Habitat Management')

@section('content')
    <div class="container">
        <h1>Habitat Management</h1>
        <a href="{{ route('habitats.create') }}" class="btn btn-primary mb-3">Create New Habitat</a>
        
        @if ($habitats->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($habitats as $habitat)
                        <tr>
                            <td>{{ $habitat->id }}</td>
                            <td>{{ $habitat->name }}</td>
                            <td>{{ Str::limit($habitat->description, 50) }}</td>
                            <td>{{ $habitat->location }}</td>
                            <td>
                                <a href="{{ route('habitats.edit', $habitat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('habitats.destroy', $habitat->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $habitats->links() }}
        @else
            <p>No habitats found.</p>
        @endif
    </div>
@endsection
