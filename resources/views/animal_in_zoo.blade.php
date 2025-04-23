@extends('layouts.user.layout')

@section('title', 'Wildlife Gallery - Zoo Management System')

@section('content')
<section class="wildlife-showcase">
    <div class="showcase-header">
        <h1 class="showcase-title">Meet Our Wildlife</h1>
        <div class="divider">
            <span class="paw-icon"><i class="pe-7s-leaf"></i></span>
        </div>
        <p class="showcase-subtitle">Discover the incredible diversity of animals in our conservation program</p>
    </div>
    
    <div class="container">
        <!-- Featured Animal - Could be randomly selected or manually featured -->
        @if(isset($featuredAnimal))
        <div class="featured-animal">
            <div class="featured-content">
                <div class="featured-image">
                    <img src="{{ asset('storage/' . $featuredAnimal->image) }}" alt="{{ $featuredAnimal->name }}">
                    <div class="featured-badge">Featured</div>
                </div>
                <div class="featured-info">
                    <h2>{{ $featuredAnimal->name }}</h2>
                    <h3 class="scientific-name">{{ $featuredAnimal->scientific_name }}</h3>
                    
                    <div class="facts-grid">
                        <div class="fact">
                            <span class="fact-icon"><i class="pe-7s-map"></i></span>
                            <div>
                                <p class="fact-label">Habitat</p>
                                <p class="fact-value">{{ $featuredAnimal->habitat }}</p>
                            </div>
                        </div>
                        
                        <div class="fact">
                            <span class="fact-icon"><i class="pe-7s-global"></i></span>
                            <div>
                                <p class="fact-label">Origin</p>
                                <p class="fact-value">{{ $featuredAnimal->origin }}</p>
                            </div>
                        </div>
                        
                        <div class="fact">
                            <span class="fact-icon"><i class="pe-7s-gleam"></i></span>
                            <div>
                                <p class="fact-label">Status</p>
                                <p class="fact-value status-{{ strtolower(str_replace(' ', '-', $featuredAnimal->conservation_status)) }}">
                                    {{ $featuredAnimal->conservation_status }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="fact">
                            <span class="fact-icon"><i class="pe-7s-news-paper"></i></span>
                            <div>
                                <p class="fact-label">Diet</p>
                                <p class="fact-value">{{ $featuredAnimal->diet }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <p class="featured-description">{{ $featuredAnimal->short_description }}</p>
                    
                    <a href="{{ route('animals.show', $featuredAnimal->id) }}" class="featured-btn">
                        <span>Learn More</span>
                        <i class="pe-7s-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Main Animals Grid -->
        <div class="animals-collection">
            <h2 class="collection-title">Our Animal Family</h2>
            
            <div class="animals-masonry">
                @foreach($animals as $animal)
                <div class="animal-tile">
                    <div class="animal-card">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('storage/' . $animal->image) }}" alt="{{ $animal->name }}">
                            <div class="card-category {{ strtolower($animal->category) }}">{{ $animal->category }}</div>
                        </div>
                        <div class="card-content">
                            <h3 class="animal-name">{{ $animal->name }}</h3>
                            <p class="animal-species">{{ $animal->species }}</p>
                            
                            <div class="card-meta">
                                <span class="meta-item">
                                    <i class="pe-7s-map-marker"></i>
                                    {{ $animal->habitat }}
                                </span>
                                <span class="meta-item status-indicator status-{{ strtolower(str_replace(' ', '-', $animal->conservation_status)) }}">
                                    <i class="pe-7s-gleam"></i>
                                    {{ $animal->conservation_status }}
                                </span>
                            </div>
                            
                            <a href="{{ route('animals.show', $animal->id) }}" class="animal-link">
                                <span>Details</span>
                                <i class="pe-7s-right-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Main Wildlife Showcase Styles */
.wildlife-showcase {
    background-color: #f8f9fa;
    padding: 60px 0;
}

.showcase-header {
    text-align: center;
    margin-bottom: 50px;
}

.showcase-title {
    font-size: 42px;
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 700;
}

.divider {
    position: relative;
    height: 20px;
    text-align: center;
    margin: 25px 0;
}

.divider:before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 2px;
    background-color: #4CAF50;
}

.paw-icon {
    position: relative;
    background-color: #f8f9fa;
    display: inline-block;
    padding: 0 15px;
}

.paw-icon i {
    font-size: 24px;
    color: #4CAF50;
}

.showcase-subtitle {
    font-size: 18px;
    color: #7f8c8d;
    max-width: 700px;
    margin: 0 auto;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Featured Animal Styles */
.featured-animal {
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 60px;
    overflow: hidden;
}

.featured-content {
    display: flex;
    flex-wrap: wrap;
}

.featured-image {
    flex: 1;
    min-width: 300px;
    position: relative;
}

.featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.featured-badge {
    position: absolute;
    top: 20px;
    left: 0;
    background: #4CAF50;
    color: white;
    padding: 8px 15px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 0 4px 4px 0;
}

.featured-info {
    flex: 1;
    min-width: 300px;
    padding: 40px;
}

.featured-info h2 {
    font-size: 36px;
    margin-bottom: 5px;
    color: #2c3e50;
}

.scientific-name {
    font-style: italic;
    color: #7f8c8d;
    font-weight: 400;
    font-size: 18px;
    margin-bottom: 25px;
}

.facts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.fact {
    display: flex;
    align-items: flex-start;
}

.fact-icon {
    margin-right: 10px;
    font-size: 24px;
    color: #4CAF50;
}

.fact-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2px;
    color: #95a5a6;
}

.fact-value {
    font-weight: 600;
    color: #2c3e50;
}

.featured-description {
    margin-bottom: 25px;
    line-height: 1.7;
    color: #34495e;
}

.featured-btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 25px;
    background: #4CAF50;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.featured-btn:hover {
    background: #388E3C;
    transform: translateY(-2px);
}

.featured-btn i {
    margin-left: 10px;
    transition: transform 0.3s ease;
}

.featured-btn:hover i {
    transform: translateX(5px);
}

/* Animal Collection Styles */
.animals-collection {
    margin-bottom: 40px;
}

.collection-title {
    font-size: 28px;
    margin-bottom: 30px;
    color: #2c3e50;
    position: relative;
    padding-left: 15px;
    border-left: 4px solid #4CAF50;
}

.animals-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    grid-gap: 25px;
}

/* Animal Tile/Card Styles */
.animal-tile {
    margin-bottom: 25px;
    break-inside: avoid;
}

.animal-card {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.animal-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
}

.card-image-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.animal-card:hover .card-image-wrapper img {
    transform: scale(1.1);
}

.card-category {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 4px 0 0 0;
}

.card-category.mammals {
    background-color: #3498db;
    color: white;
}

.card-category.birds {
    background-color: #e74c3c;
    color: white;
}

.card-category.reptiles {
    background-color: #f39c12;
    color: white;
}

.card-category.aquatic {
    background-color: #1abc9c;
    color: white;
}

.card-category.insects {
    background-color: #9b59b6;
    color: white;
}

.card-content {
    padding: 20px;
}

.animal-name {
    font-size: 20px;
    margin-bottom: 5px;
    color: #2c3e50;
}

.animal-species {
    font-style: italic;
    color: #7f8c8d;
    margin-bottom: 15px;
    font-size: 14px;
}

.card-meta {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 15px;
    gap: 10px;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 13px;
    color: #7f8c8d;
    margin-right: 15px;
}

.meta-item i {
    margin-right: 5px;
    color: #4CAF50;
}

.animal-link {
    display: inline-flex;
    align-items: center;
    font-size: 14px;
    font-weight: 600;
    color: #4CAF50;
    text-decoration: none;
    transition: all 0.3s ease;
}

.animal-link i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.animal-link:hover {
    color: #388E3C;
}

.animal-link:hover i {
    transform: translateX(5px);
}

/* Conservation Status Colors */
.status-indicator {
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 12px;
    font-weight: 600;
}

.status-extinct {
    background-color: #000;
    color: white !important;
}

.status-extinct-in-the-wild {
    background-color: #5D4037;
    color: white !important;
}

.status-critically-endangered {
    background-color: #d32f2f;
    color: white !important;
}

.status-endangered {
    background-color: #f44336;
    color: white !important;
}

.status-vulnerable {
    background-color: #ff9800;
    color: white !important;
}

.status-near-threatened {
    background-color: #FFC107;
    color: #333 !important;
}

.status-least-concern {
    background-color: #4CAF50;
    color: white !important;
}

.status-data-deficient {
    background-color: #9E9E9E;
    color: white !important;
}

.status-not-evaluated {
    background-color: #607D8B;
    color: white !important;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .featured-content {
        flex-direction: column;
    }
    
    .featured-image, .featured-info {
        width: 100%;
    }
    
    .featured-image {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .wildlife-showcase {
        padding: 40px 0;
    }
    
    .showcase-title {
        font-size: 32px;
    }
    
    .facts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .animals-masonry {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }
}

@media (max-width: 480px) {
    .showcase-title {
        font-size: 28px;
    }
    
    .facts-grid {
        grid-template-columns: 1fr;
    }
    
    .featured-info {
        padding: 25px;
    }
    
    .animals-masonry {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- PE-icon-7-stroke library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
@endpush
@endsection