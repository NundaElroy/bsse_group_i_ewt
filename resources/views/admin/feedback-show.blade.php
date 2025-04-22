@extends('layouts.admin.layout')
@section('title', 'feedbackview')

@section('content')
<div class="feedbackview-table-container">

    <div class="container mt-5">
        <h1>Feedback Details</h1>
        <div class="card">
            <div class="card-header">
                <h5>From: {{ $feedback->email }}</h5>
            </div>
            <div class="card-body">
            <p><strong>Email:</strong>{{ $feedback->email }} </p>
                <p><strong>Subject:</strong> {{ $feedback->subject ?? 'Feedback from ' . $feedback->email }}</p>
                <p><strong>Comment:</strong> {{ $feedback->comment }}</p>
                <p><strong>Rating:</strong> {{ $feedback->rating ?? 'N/A' }}</p>
                <p><strong>Date:</strong> {{ $feedback->date->format('Y-m-d') }}</p>
                <p><strong>Submitted At:</strong> {{ $feedback->created_at->format('Y-m-d H:i:s') }}</p>
                <!-- <p><strong>Reply:</strong> <a href="mailto:{{ $feedback->email }}?subject=Re: {{ $feedback->email_subject ?? 'Your Feedback' }}">Send Email</a></p> -->
            </div>
        </div>
        <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary mt-3">Back to Feedback List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</div>
@endsection