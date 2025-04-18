@extends('layouts.admin.layout')
@section('title', 'feedback')

@section('content')<div class="employee-container">
    <div class="employee-header">
        <h2>Visitor Feedback</h2>
        <!-- Button removed since it's not in the original feedback table -->
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-wrapper">
        <table class="employee-table" id="dataTable">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Comment</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->subject }}</td>
                        <td>{{ Str::limit($feedback->comment, 50) }}</td>
                        <td>{{ $feedback->rating ?? 'N/A' }}</td>
                        <!-- change on date handling -->
                        <td>{{ $feedback->date ? $feedback->date->format('M d, Y') :'N/A' }}</td>
                        <td class="actions">
                        <td>{{ $feedback->date->format('M d, Y') }}</td>
                        <td >
                            <div class="actions">
                            <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="btn-edit">View Details</a>
                            </div>
                           
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No feedback found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection



