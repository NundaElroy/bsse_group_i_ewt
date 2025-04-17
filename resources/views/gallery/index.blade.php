@extends('layouts.admin.layout')

@section('title', 'Gallery Items')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Gallery Items</h2>
        <a href="{{ route('galleries.create') }}" class="btn btn-primary">Add Gallery</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table">
            <thead>
                <tr>
                     <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td>
                            @if($gallery->image)
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" style="height: 120px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $gallery->title }}</td>
                        <td>{{ Str::limit($gallery->description, 50) }}</td>
                        <td  >
                            <div class="actions">
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this gallery item?')">Delete</button>
                            </form>
                            </div>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No gallery items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
