@extends('layouts.admin.layout')
@section('title', 'feedbackview')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-5">
    <h1>Feedback Details</h1>
    <div class="card">
        <div class="card-header">
            <h3>From: {{ $feedback->email }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $feedback->email }}</p>
            <p><strong>Subject:</strong> {{ $feedback->subject ?? 'Feedback from ' . $feedback->email }}</p>
            <p><strong>Comment:</strong> {{ $feedback->comment }}</p>
            <p><strong>Rating:</strong> {{ $feedback->rating ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $feedback->date->format('Y-m-d') }}</p>
            <p><strong>Submitted At:</strong> {{ $feedback->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
    <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary mt-3">Back to Feedback List</a>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection