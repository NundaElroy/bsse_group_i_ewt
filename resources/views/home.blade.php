 
@extends('layouts.user.layout')

@section('title', 'Home - Zoo Management System')

@section('content')
<div id="bg-section" style="margin-top: 10px; min-height: 100vh;">
    <!-- Hero Section -->
<div class="hero">
    <div class="hero-content">
        <h2>Welcome to the Wild Side of Life 🐅</h2>
        <p>Explore animals, learn more,and enjoy the wilderness,all in one place.</p>
        <a href="#about-zoo" class="btn-visit">Explore the Zoo</a>
    </div>
</div>

<!-- About the Zoo Section -->
<div id="about-zoo" class="about-section">
    <h2>About Sebabe's Zoo</h2>
    <p>
        Sebabe's Zoo is more than just a home for wild animals, it's an educational and adventurous experience for everyone.
        From the mighty lions to the gentle giraffes, we host a variety of species to help you connect with nature like never before.
    </p>
    <p>
        Our mission is to promote conservation, education, and joy through wildlife. Whether you're a student, tourist, or researcher, there's always something to explore at our zoo.
    </p>
</div>

<!-- Featured Animals Section -->
<div id="featured-animals" class="animals-section">
    <h2>Featured Animals</h2>
    <div class="animal-cards">
        <div class="animal-card">
            <img src="{{ asset('images/lion.jpg') }}" alt="Lion">
            <h3>Lion</h3>
            <p>The king of the jungle, strong and majestic.</p>
        </div>
        <div class="animal-card">
            <img src="{{ asset('images/elephant.jpg') }}" alt="Elephant">
            <h3>Elephant</h3>
            <p>Gentle giants with amazing memory and strength.</p>
        </div>
        <div class="animal-card">
            <img src="{{ asset('images/zebra.jpg') }}" alt="Zebra">
            <h3>Zebra</h3>
            <p>Striking black-and-white stripes and social herds.</p>
        </div>
    </div>
</div>

<!-- Visit Info Section -->
<div class="visit-section" id="visit-info">
    <h2>Plan Your Visit</h2>
    <p>Come see the wildlife up close! Here's how to reach us:</p>
    <div class="visit-details">
        <div class="visit-card">
            <h3>📍 Location</h3>
            <p>Entebbe Zoo Grounds, Kampala, Uganda</p>
        </div>
        <div class="visit-card">
            <h3>📞 Contact</h3>
            <p>+256 700 123456</p>
            <p>Email: info@sebabezoo.com</p>
        </div>
        <div class="visit-card">
            <h3>🕒 Opening Hours</h3>
            <p>Mon - Sun: 8:00 AM - 6:00 PM</p>
        </div>
    </div>
</div>



</div>
<!-- JavaScript for Changing Background Image -->
<script>
    const animalImages = [
        //"{{ asset('images/cub.jpg') }}",
        //"{{ asset('images/elephant.jpg') }}",
        //"{{ asset('images/crestedcrane.jpg') }}",
        "{{ asset('images/giraffer.jpg') }}",
        //"{{ asset('images/antelope.jpg') }}"
    ];

    function changeBackgroundImage() {
    const randomImage = animalImages[Math.floor(Math.random() * animalImages.length)];
    const bgSection = document.getElementById("bg-section");

    bgSection.style.backgroundImage = `url(${randomImage})`;
    bgSection.style.backgroundSize = "cover";
    bgSection.style.backgroundPosition = "center  center";
    bgSection.style.backgroundAttachment = "fixed";
}


    setInterval(changeBackgroundImage, 5000); // Change image every 5 seconds

    const exploreBtn = document.querySelector('.btn-visit');
    if (exploreBtn) {
        exploreBtn.addEventListener('click', () => {
            changeBackgroundImage();  // Change background on button click
        });
    }
</script>

<!-- CSS for smooth transition -->
<style>
    body {
        transition: background-image 1s ease-in-out;
    }
</style>

@endsection
