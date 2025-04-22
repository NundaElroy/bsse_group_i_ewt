<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zoo Website')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/employee.css') }}">
    <link rel="stylesheet" href="{{ asset('css/locations.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <!-- trying to add some css here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Backdrop for mobile -->
    <div class="backdrop" id="backdrop"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <img src="{{ asset('images/zoolg.png') }}" alt="" style="width: 95px; border-radius: 20%">
            <span class="admin-text">ADMIN</span>
        </div>
        
        <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-table-columns menu-icon"></i>
            Dashboard
        </a>
        
        <div class="section-title">ANIMALS</div>
        
        <a href="#" class="menu-item">
        
            <i class="fa-solid fa-hippo menu-icon"></i>
            Animals Management
        </a>
        
        <a href="#" class="menu-item">
            <i class="fa-solid fa-file-lines menu-icon"></i>
            Medical Records 
        </a>

        <!-- <div class="section-title">LOCATIONS</div> -->
        <a href="{{ route('locations.index') }}" class="menu-item {{ request()->routeIs('locations*') ? 'active' : '' }}">
           <i class="fa-solid fa-house menu-icon"></i> 
             Habitats
        </a>

        <a href="{{ route('inventories.index') }}" class="menu-item {{ request()->routeIs('inventories*') ? 'active' : '' }}">
           <i class="fa-solid fa-warehouse menu-icon"></i> 
             Inventory
        </a>
        
                
        <div class="section-title">EMPLOYEES</div>
        <a href="{{ route('employees.index') }}" class="menu-item {{ request()->routeIs('employees*') ? 'active' : '' }}"
        >
          <i class="fa-solid fa-user-pen menu-icon"></i> Employee Management </a>

        <div class="section-title">VISITORS</div>
        <a href="{{ route('tickets') }}" class="menu-item {{ request()->routeIs('tickets') ? 'active' : '' }}">
            <i class="fa-solid fa-ticket menu-icon"></i>
            Tickets
        </a>

        <a href="{{ route('bookings') }}" class="menu-item {{ request()->routeIs('bookings') ? 'active' : '' }}">
            <i class="fa-solid fa-ticket menu-icon"></i>
            View Bookings
        </a>
        
        <!-- <div class="section-title">Visitors</div> -->
        <a href="{{ route('visitors') }}" class="menu-item {{ request()->routeIs('visitors') ? 'active' : '' }}">
            <i class="fa-solid  fa-person-walking-luggage menu-icon"></i>
            Visitors
        </a>

        

        <a href="{{route('admin.feedback.index') }}" class="menu-item {{ request()->routeIs('feedback') ? 'active' : '' }}">
            <i class="fa-solid fa-comment menu-icon"></i>
            Feedback
        </a>
        
        <!-- 
         -->
        
        <a href="{{ route('events.index') }}" class="menu-item {{ request()->routeIs('events*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-calendar menu-icon"></i>
            Events
        </a>
        
        <a href="{{ route('galleries.index') }}" class="menu-item {{ request()->routeIs('galleries*') ? 'active' : '' }}">
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
    @stack('scripts')

    
     <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
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


        

    document.addEventListener("DOMContentLoaded", function() {
       
        const dataTable = new simpleDatatables.DataTable("#dataTable", {
            searchable: true,
            perPage: 10,
            labels: {
                placeholder: "Search...",
                perPage: "",
            }
        });
        
      
    });




    </script>

</body>
</html>