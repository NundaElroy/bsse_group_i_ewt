@extends('layouts.admin.layout')
@section('title', 'feedback')

@section('content')
<div class="feedback-table-container">

    <div class="container mt-5">
        <h1>Visitor Feedback</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <!-- <th>Subject</th> -->
                    <th>Comment</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->email }}</td>
                        <!-- <td>{{ $feedback->email_subject ?? 'Feedback from ' . $feedback->email }}</td> -->
                        <td>{{ Str::limit($feedback->comment, 50) }}</td>
                        <td>{{ $feedback->rating ?? 'N/A' }}</td>
                        <td>{{ $feedback->date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="btn btn-sm btn-primary">View Details</a>
                        </td>
                        <!-- email linking to user profile trial -->
                        <!-- <td>  @if ($feedback->user)
                        <a href="{{ route('admin.users.show', $feedback->user->id) }}">{{ $feedback->email }}</a>@else
                           {{ $feedback->email }}   @endif</td> -->
                           
 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection



