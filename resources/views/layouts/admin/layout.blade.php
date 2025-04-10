<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zoo Website')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Backdrop for mobile -->
    <div class="backdrop" id="backdrop"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <img src="{{ asset('images/zoolg.png') }}" alt="" style="width: 95px; border-radius: 20%">
        </div>
        
        <a href="{{ route('dashboard') }}" class="menu-item active">
            <i class="fa-solid fa-table-columns menu-icon"></i>
            Dashboard
        </a>
        
        <div class="section-title">Animals</div>
        
        <a href="#" class="menu-item">
        
            <i class="fa-solid fa-hippo menu-icon"></i>
            Animals Management
        </a>
        
        <a href="#" class="menu-item">
            <i class="fa-solid fa-file-lines menu-icon"></i>
            Medical Records 
        </a>

        <div class="section-title">Locations</div>
        <a href="#" class="menu-item">
            <i class="fa-solid fa-warehouse menu-icon"></i>
            Locations
        </a>
        <div class="section-title">Employees</div>
        
        <a href="#" class="menu-item">
            <i class="fa-solid fa-user-pen menu-icon"></i>
            Employee Management
        </a>
        
        
        <div class="section-title">Visitors</div>
        <a href="#" class="menu-item">
            <i class="fa-solid  fa-person-walking-luggage"></i>
            Visitors
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-ticket menu-icon"></i>
            Tickets
        </a>

        <a href="#" class="menu-item">
            <i class="fa-solid fa-comment menu-icon"></i>
            Feedback
        </a>
        
        <div class="section-title">Website</div>
        
        <a href="#" class="menu-item">
            <i class="fa-solid fa-calendar menu-icon"></i>
            Events
        </a>
        
        <a href="#" class="menu-item">
            <i class="fa-solid fa-file-export menu-icon"></i>
            Gallery
        </a>
        
        
        
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

        <a href="javascript:void(0)" class="menu-item menu-logout" onclick="document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket menu-icon"></i>
            LOG OUT
        </a>

    </aside>
    
    <!-- Main Content Area -->
    <main class="main-content">
        <nav class="top-navbar">
            <div class="nav-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            
            <div class="nav-tabs">
                
            </div>
            
            <div class="nav-right">
                
                <div class="profile-avatar">
                    <img src="{{ asset('images/user-avatar.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </nav>
        
        <!-- Page content -->
        <div class="content-area">
            <!-- main  content would go here -->
            <!-- <h2>Admin Dashboard</h2>
            <p>Your dashboard content appears here.</p> -->
            @yield('content')
            
        </div>
    </main>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('backdrop').classList.toggle('active');
        });
        
        // Close sidebar when backdrop is clicked
        document.getElementById('backdrop').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('backdrop').classList.remove('active');
        });
        
        // Close sidebar when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                document.getElementById('sidebar').classList.remove('active');
                document.getElementById('backdrop').classList.remove('active');
            }
        });
    </script>
</body>
</html>