@extends('layouts.user.layout')

@section('title', 'Gallery - Zoo Management System')

@section('content')
    <div class="gallery-container">
        <h2 class="gallery-heading">Image Gallery</h2>
        <p class="gallery-lead">Photos of animals in their habitat.</p>
        <div class="gallery-grid">
            <a href="" data-lightbox="gallery" data-title="Description of Project No.1" class="gallery-item">
                <img src="{{ asset('images/antelope.jpg') }}" alt="antellope" class="gallery-image">
            </a>
            <a href="" data-lightbox="gallery" data-title="Description of Project No.1" class="gallery-item">
                <img src="{{ asset('images/giraffer.jpg') }}" alt="giraffe" class="gallery-image">
            </a>
            <a href="" data-lightbox="gallery" data-title="Description of Project No.1" class="gallery-item">
                <img src="{{ asset('images/cub.jpg') }}" alt="pathera lion" class="gallery-image">
            </a>
            <a href="" data-lightbox="gallery" data-title="Description of Project No.1" class="gallery-item">
                <img src="{{ asset('images/zebra.jpg') }}" alt="zebra" class="gallery-image">
            </a>
            <a href="" data-lightbox="gallery" data-title="Description of Project No.1" class="gallery-item">
                <img src="{{ asset('images/crestedcrane.jpg') }}" alt="Crested crane" class="gallery-image">
            </a>
        </div>
        
       
    </div>
@endsection

@push('styles')
<style>
    .gallery-container {
        padding: 40px 0;
        max-width: 1140px;
        margin: 0 auto;
    }
    
    .gallery-heading {
        margin-bottom: 20px;
        position: relative;
        font-size: 24px;
    }
    
    .gallery-heading::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 100%;
        height: 1px;
        background-color: #e0e0e0;
    }
    
    .video-heading {
        margin-top: 40px;
    }
    
    .gallery-lead {
        font-size: 18px;
        font-weight: 300;
        margin-bottom: 20px;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
    }
    
    .gallery-item {
        overflow: hidden;
        position: relative;
        display: block;
    }
    
    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }
    
    .video-grid {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .gallery-container {
            padding: 20px 15px;
        }
        
        .gallery-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush