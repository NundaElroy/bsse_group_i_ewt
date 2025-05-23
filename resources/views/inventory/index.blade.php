@extends('layouts.admin.layout')

@section('title', 'Inventory')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>All Inventory</h2>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">Add Inventory</a>
    </div>

    @if(session('success'))
    <div style="padding: 12px 20px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724; background-color: #d4edda; font-family: system-ui, -apple-system, sans-serif;">{{ session('success') }}</div>
    @endif

    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Manager</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->inventory_type }}</td>
                        <td>{{ $inventory->description ?? 'N/A' }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->manager->name ?? 'N/A' }}</td>
                        <td>
                            @if($inventory->image)
                                <img style="height: 120px;" src="{{ asset('storage/' . $inventory->image) }}"   alt="{{ $inventory->name }}"/>

                            @else
                                No Image
                            @endif
                        </td>
                        <td >
                            <div  class="actions">
                            <a href="{{ route('inventories.edit', $inventory) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No inventory found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
