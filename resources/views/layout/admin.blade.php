<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Benedicto College</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/adminhome.css') }}">
    @yield('extra-css')
</head>
<body>

    <div id="confirmModal" class="modal-overlay">
        <div class="modal-box">
            <h3 id="modalTitle">Logout</h3>
            <p id="modalMessage">Are you sure you want to log out of the system?</p>
            <div class="modal-buttons">
                <button class="btn-cancel" id="cancelLogout">Cancel</button>
                <button class="btn-confirm" id="modalConfirmBtn">Confirm</button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <header class="main-header">
        <div class="logo-section">
            <div class="logo-circle">
                <img src="https://scontent.fmnl17-3.fna.fbcdn.net/..." alt="Logo" class="header-logo">
            </div>
            <div class="logo-text">
                <h1>Facility Reservation System</h1>
                <p>Book rooms and facilities easily</p>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-admin"><i class='bx bx-shield-quarter'></i> Admin User</button>
            <button class="btn-logout" id="logoutBtn"><i class='bx bx-log-out'></i> Logout</button>
        </div>
    </header>

    <nav class="main-nav">
        <div class="nav-container">
            <a href="{{ route('admin.home') }}" 
               class="nav-item {{ Route::is('admin.home') ? 'active' : '' }}">
               <i class='bx bx-home-alt'></i> Overview
            </a>
            
            <a href="{{ route('admin.reservations') }}" 
               class="nav-item {{ Route::is('admin.reservations') ? 'active' : '' }}">
               <i class='bx bx-calendar-event'></i> Reservations
            </a>
            
            <a href="{{ route('admin.facilities') }}" 
               class="nav-item {{ Route::is('admin.facilities') ? 'active' : '' }}">
               <i class='bx bx-building-house'></i> Facilities
            </a>
        </div>
    </nav>

    <main class="content-area">
        @yield('content')
    </main>

    <script src="{{ asset('js/shared-admin.js') }}"></script>
    @yield('extra-js')
</body>
</html>