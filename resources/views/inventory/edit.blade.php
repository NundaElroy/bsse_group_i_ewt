@extends('layouts.admin.layout')

@section('title', 'Edit Inventory')
@section('content')
<div class="employee-form-wrapper">
    <div class="employee-form-container">
        <div class="employee-header">
            <h2>Edit Inventory</h2>
            <p class="employee-subtitle">Update the inventory details below</p>
        </div>

        <form action="{{ route('inventories.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="employee-form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name', $inventory->name) }}" required>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Inventory Type --}}
            <div class="employee-form-group">
                <label for="inventory_type">Type</label>
                <select name="inventory_type" required>
                    <option value="Food" {{ old('inventory_type', $inventory->inventory_type) == 'Food' ? 'selected' : '' }}>Food</option>
                    <option value="Medicine" {{ old('inventory_type', $inventory->inventory_type) == 'Medicine' ? 'selected' : '' }}>Medicine</option>
                    <option value="Equipment" {{ old('inventory_type', $inventory->inventory_type) == 'Equipment' ? 'selected' : '' }}>Equipment</option>
                </select>
                @error('inventory_type')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="employee-form-group">
                <label for="description">Description</label>
                <textarea name="description">{{ old('description', $inventory->description) }}</textarea>
                @error('description')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Quantity --}}
            <div class="employee-form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity', $inventory->quantity) }}" min="0">
                @error('quantity')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Employee --}}
            <div class="employee-form-group">
                <label for="employee_id">Manager</label>
                <select name="employee_id" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id', $inventory->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="employee-form-group">
                <label for="image">Inventory Image</label>
                <input type="file" name="image">
                @if($inventory->image)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $inventory->image) }}" alt="{{ $inventory->name }}" width="100">
                    </div>
                @endif
                @error('image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="employee-form-buttons">
                <button type="submit">Update Inventory</button>
                <a href="{{ route('inventories.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
