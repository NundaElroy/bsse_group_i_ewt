@extends('layouts.admin.layout')

@section('title', 'Visitors')

@section('content')
<div class="employee-container">
    <div class="employee-header">
        <h2>Visitors</h2>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Visitor Type</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Document Type</th>
                    <th>Document Number</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->id }}</td>
                        <td>{{ $visitor->full_name }}</td>
                        <td>{{ ucfirst($visitor->visitor_type) }}</td>
                        <td>{{ $visitor->email }}</td>
                        <td>{{ $visitor->address ?? 'N/A' }}</td>
                        <td>{{ ucfirst($visitor->document_type) }}</td>
                        <td>{{ $visitor->document_number }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No visitors registered yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection