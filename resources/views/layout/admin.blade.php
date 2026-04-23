<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Benedicto College</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminhome.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/380790490_810610521073768_1413158087196732061_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=1d70fc&_nc_eui2=AeGevFTcyEEg8FLGksLW7tfTjRg-_uuZFZaNGD7-65kVliRyjXxY9EBA6fdLY3Sse2cl7Rr7XKRfrgnlO7BXAlKk&_nc_ohc=ek-8v86NVkUQ7kNvwFN2R8R&_nc_oc=AdqBIAJOhBrsCg8Zja_D7_YGVyMkxiHTZpfniIp_P5Lmal_--eYskxEhC03xlaots4U&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=-8ICfkLpNxpDx8H76WTpOg&_nc_ss=7a3a8&oh=00_Af1xxnN8an7ZhlfJc8CZcVDwpdZxaYzdm9I2cz-iZ1--wA&oe=69EC3210" alt="Logo" class="header-logo">
            </div>
            <div class="logo-text">
                <h1>Facility Reservation System</h1>
                <p>Book rooms and facilities easily</p>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-admin"><i class='bx bx-shield-quarter'></i> Admin User</button>
            
            <button class="btn-logout" id="logoutBtn" onclick="forceLogout(event)">
                <i class='bx bx-log-out'></i> Logout
            </button>
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

    <script>
        function forceLogout(e) {
            if (e) e.preventDefault();
            const modal = document.getElementById('confirmModal');
            if (modal) {
                modal.style.display = 'flex';
            } else {
                if(confirm('Are you sure you want to log out?')) {
                    document.getElementById('logout-form').submit();
                }
            }
        }
    </script>

    <script src="{{ asset('js/shared-admin.js') }}"></script>
    @yield('extra-js')

    <script>
    // 1. Function to open the modal
    function forceLogout(e) {
        if (e) e.preventDefault();
        const modal = document.getElementById('confirmModal');
        if (modal) {
            modal.style.display = 'flex';
        } else {
            // Emergency fallback if modal is missing from HTML
            if(confirm('Are you sure you want to log out?')) {
                document.getElementById('logout-form').submit();
            }
        }
    }

    // 2. Set up the button actions once the page loads
    document.addEventListener('DOMContentLoaded', function() {
        const modalConfirmBtn = document.getElementById('modalConfirmBtn');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmModal = document.getElementById('confirmModal');
        const logoutForm = document.getElementById('logout-form');

        // Confirm button: Submit the hidden form
        if (modalConfirmBtn) {
            modalConfirmBtn.onclick = function() {
                if (logoutForm) {
                    logoutForm.submit();
                }
            };
        }

        // Cancel button: Hide the modal
        if (cancelLogout) {
            cancelLogout.onclick = function() {
                if (confirmModal) {
                    confirmModal.style.display = 'none';
                }
            };
        }

        // Background click: Hide the modal
        window.onclick = function(event) {
            if (event.target === confirmModal) {
                confirmModal.style.display = 'none';
            }
        };
    });
</script>
</body>
</html>