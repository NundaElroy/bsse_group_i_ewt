@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <h1>Medical Records</h1>
    <a href="{{ route('medical-records.create') }}" class="btn btn-primary mb-3">Add New Record</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Animal</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicalRecords as $record)
                <tr>
                    <td>{{ $record->animal->name }}</td>
                    <td>{{ $record->diagnosis }}</td>
                    <td>{{ $record->treatment }}</td>
                    <td>{{ $record->treatment_date }}</td>
                    <td>
                        <a href="{{ route('medical-records.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('medical-records.destroy', $record->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
