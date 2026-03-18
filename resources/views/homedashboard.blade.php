<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Benedicto College - Facility Reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="app.css">
</head>
<body>

<div class="d-flex">
    @auth
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-circle">BC</div>
            <span class="brand-text">Benedicto College</span>
        </div>
        
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="nav-link-custom active">
                <i class="fas fa-home"></i> <span>Home</span>
            </a>
            <a href="{{ route('books.index') }}" class="nav-link-custom">
                <i class="fas fa-building"></i> <span>Facilities</span>
            </a>
            <a href="{{ route('loans.index') }}" class="nav-link-custom">
                <i class="fas fa-clipboard-list"></i> <span>My Reservation</span>
            </a>
            <a href="#" class="nav-link-custom">
                <i class="fas fa-calendar-alt"></i> <span>Calendar</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>
    @endauth

    <div class="main-wrapper @guest w-100 m-0 @endguest">
        
        <header class="top-bar">
            <div class="header-info">
                <h1 class="h5 mb-0 fw-bold">School Facility Reservation System</h1>
                <p class="small text-muted mb-0">Benedicto College Library</p>
            </div>
            
            @auth
            <div class="header-user">
                <div class="user-meta d-none d-sm-block">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-id text-muted">{{ Auth::user()->email }}</span>
                </div>
                <div class="avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
            @endauth
        </header>

        <main class="content-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="text-center text-muted py-4 small">
            © {{ date('Y') }} Benedicto College Library
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>