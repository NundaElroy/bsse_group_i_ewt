@extends('layouts.user.layout')

@section('title', 'About Us - Zoo Management System')




@section('content')
<div class="events-container">
    <h2 class="events-heading">Events</h2>

    @if($events->isEmpty())
    <div class="events-row">
            <div class="events-column">
                <div class="event-card">
                <p>No events available at the moment.</p>
                </div>
            </div>
        </div>
        
    @else
        <div class="events-row">
            @foreach($events as $event)
                <div class="events-column">
                    <div class="event-card">
                        <h3 class="event-title">{{ $event->name }}</h3>
                        <div class="event-image">
                            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" width="250">
                        </div>
                        <p class="event-detail">
                            <span class="label">Description:</span> 
                            <span class="detail-text">{{ $event->description }}</span>
                        </p>
                        <p class="event-detail">
                            <span class="label">Personnel</span> 
                            <span class="detail-text">{{$event->employee->name}}</span>
                        </p>
                        <p class="event-detail">
                            <span class="label">Event Duration:</span> 
                            <span class="detail-text">{{ \Carbon\Carbon::parse($event->start_time)->format('F d, Y @ h:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('F d, Y @ h:i A') }}</span>
                        </p>
                        <p class="event-detail">
                            <span class="label">Event Start Date:</span> 
                            <span class="detail-text">{{ \Carbon\Carbon::parse($event->start_time)->toDateString() }}</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


@push('styles')
<style>
    .events-container {
        padding: 40px 0;
        max-width: 1140px;
        margin: 0 auto;
    }

    .events-heading {
        margin-bottom: 20px;
        position: relative;
        font-size: 24px;
    }

    .events-heading::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 100%;
        height: 1px;
        background-color: #e0e0e0;
    }

    .events-row {
        display: flex;
        flex-wrap: wrap;
    }

    .events-column {
        flex: 1;
        margin-top: 15px;
        min-width: 300px;
    }

    .event-card {
        border: 1px solid #dee2e6;
        background-color: white;
        padding: 20px;
        margin-top: 15px;
        height: 400px;
    }

    .event-title {
        font-weight: normal;
        margin-bottom: 15px;
        font-size: 20px;
    }

    .event-image {
        margin-bottom: 10px;
    }

    .event-detail {
        margin: 0;
        padding: 5px 0;
    }

    .label {
        font-weight: bold;
        font-style: italic;
    }

    .detail-text {
        font-weight: normal;
    }

    @media (max-width: 768px) {
        .events-container {
            padding: 20px 15px;
        }
        
        .events-column {
            flex: 0 0 100%;
        }
    }
</style>
@endpush