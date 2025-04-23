@extends('layouts.user.layout')

@section('title', 'Events - Zoo Management System')

@section('content')
<div class="events-container">
    <div class="events-header">
        <h2 class="events-heading">Upcoming Events</h2>
        <p class="events-subheading">Join us for these exciting activities at the zoo</p>
    </div>

    @if($events->isEmpty())
    <div class="no-events">
        <div class="no-events-icon">
            <i class="fas fa-calendar-times"></i>
        </div>
        <p>No events scheduled at the moment.</p>
        <p class="check-back">Please check back later for upcoming activities!</p>
    </div>
    @else
        <div class="events-grid">
            @foreach($events as $event)
                <div class="event-card">
                    <div class="event-image">
                        @if($event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}">
                        @else
                            <img src="{{ asset('images/default-event.jpg') }}" alt="Default Event Image">
                        @endif
                        <div class="event-status {{ $event->status }}">{{ ucfirst($event->status) }}</div>
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">{{ $event->name }}</h3>
                        
                        <div class="event-meta">
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>{{ \Carbon\Carbon::parse($event->start_time)->format('F d, Y') }}</span>
                            </div>
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</span>
                            </div>
                        </div>
                        
                        <div class="event-description">
                            <p>{{ Str::limit($event->description, 120) }}</p>
                        </div>
                        
                        <div class="event-footer">
                            <div class="event-host">
                                <i class="fas fa-user"></i>
                                <span>Hosted by: {{ $event->employee->name }}</span>
                            </div>
                            <a href="#" class="event-details-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($events) > 6)
        <div class="load-more">
            <button class="load-more-btn">Load More Events</button>
        </div>
        @endif
    @endif
</div>
@endsection


@push('styles')
<style>
    .events-container {
        padding: 60px 0;
        max-width: 1200px;
        margin: 0 auto;
    }

    .events-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .events-heading {
        font-size: 36px;
        color: #2c3e50;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .events-heading::after {
        content: "";
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -10px;
        width: 80px;
        height: 3px;
        background-color: #27ae60;
    }

    .events-subheading {
        color: #7f8c8d;
        font-size: 18px;
        margin-top: 20px;
    }

    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .event-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: white;
        height: 100%;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .event-image {
        height: 200px;
        position: relative;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .event-card:hover .event-image img {
        transform: scale(1.1);
    }

    .event-status {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        color: white;
    }

    .event-status.upcoming {
        background-color: #2ecc71;
    }

    .event-status.past {
        background-color: #e74c3c;
    }

    .event-content {
        padding: 20px;
    }

    .event-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #34495e;
    }

    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        color: #7f8c8d;
        font-size: 14px;
    }

    .event-meta-item i {
        margin-right: 8px;
        color: #3498db;
        width: 16px;
    }

    .event-description {
        margin-bottom: 20px;
        color: #576574;
        font-size: 15px;
        line-height: 1.5;
    }

    .event-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #ecf0f1;
    }

    .event-host {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #7f8c8d;
    }

    .event-host i {
        margin-right: 5px;
        color: #9b59b6;
    }

    .event-details-btn {
        display: inline-block;
        padding: 8px 15px;
        background-color: #27ae60;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .event-details-btn:hover {
        background-color: #219652;
    }

    .no-events {
        text-align: center;
        padding: 60px 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .no-events-icon {
        font-size: 50px;
        color: #bdc3c7;
        margin-bottom: 20px;
    }

    .no-events p {
        font-size: 18px;
        color: #7f8c8d;
        margin-bottom: 10px;
    }

    .check-back {
        font-size: 16px;
        color: #95a5a6;
    }

    .load-more {
        text-align: center;
        margin-top: 40px;
    }

    .load-more-btn {
        background-color: transparent;
        border: 2px solid #3498db;
        color: #3498db;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }

    .load-more-btn:hover {
        background-color: #3498db;
        color: white;
    }

    @media (max-width: 768px) {
        .events-container {
            padding: 40px 15px;
        }
        
        .events-grid {
            grid-template-columns: 1fr;
        }
        
        .events-heading {
            font-size: 28px;
        }
        
        .events-subheading {
            font-size: 16px;
        }
    }
</style>
@endpush