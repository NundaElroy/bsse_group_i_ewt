<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Zoo Website')</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  
  @stack('styles')
</head>
<body>
  <header>
    <div class="container">
      <nav>
        <a href="{{ url('home') }}" class="logo">
          <img src="{{ asset('images/San-Diego-Zoo-Logo.png') }}" alt="Zoo Logo">
        </a>
       
        <button class="menu-toggle">Menu ☰</button>
        
        <ul class="nav-menu">
          <li class="nav-item"><a href="{{ url('home') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ url('gallery') }}" class="nav-link">Gallery</a></li>
          <li class="nav-item"><a href="{{ url('view-animals') }}" class="nav-link">Animals </span></a></li>
          <li class="nav-item"><a href="{{ url('book_ticket') }}" class="nav-link">Book Tickets</a></li>
          <!-- <li class="nav-item"><a href="{{ url('careers') }}" class="nav-link">Careers</a></li> -->
          <li class="nav-item"><a href="{{ url('evens') }}" class="nav-link">Events</a></li>
          <!-- <li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact Us</a></li> -->
          <li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact Us</a></li>

        </ul>
      </nav>
    </div>
  </header>

  <main   style="padding-top: 60px;">
    @yield('content')
  </main>

  <footer>
    <div class="container">
      <div class="footer-row">
        <div class="footer-column large-column">
          <h5 class="footer-heading">About Sebabe Conservation Center</h5>
          <p class="footer-text">The Uganda Wildlife Conservation Education Center is a fun and exciting place to see and learn about the animals of Uganda and the ecosystems in which they live. Take some time to learn how they live, eat, play, and walk.</p>
        </div>
        <div class="footer-column">
          
          <h5 class="footer-heading">Our Location</h5>
          <p class="footer-text">Lugard Avenue <br>Entebbe, Uganda<br>Mobile: +256 414 320 520<br>email:info.zoo.co.ug</p>
        </div>
        <div class="footer-column">
          
          <h5 class="footer-heading">Our Sponsors</h5>
          <p class="footer-text">Ministry of Finance <br>USAID<br>Uganda Airlines<br>Uganda Baati</p>
        </div>
        <div class="footer-column">
          <h5 class="footer-heading">Popular Animals</h5>
          <ul class="footer-list">
            <li><a href="#" class="footer-link">Mammals</a></li>
            <li><a href="#" class="footer-link">Reptiles &amp; Amphibians</a></li>
            <li><a href="#" class="footer-link">Birds</a></li>
            <li><a href="#" class="footer-link">Carnivores</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h5 class="footer-heading">Connect with us</h5>
          <ul class="social-list">
            <li><a href="#" class="social-link facebook">Facebook</a></li>
            <li><a href="#" class="social-link google">Google+</a></li>
            <li><a href="#" class="social-link twitter">Twitter</a></li>
            <li><a href="#" class="social-link mail">Mail</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="copyright">
      <p>© 2025 - Sebabe Zoo</p>
    </div>
  </footer>
 
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
    });

    
  </script>
</body>
</html>
