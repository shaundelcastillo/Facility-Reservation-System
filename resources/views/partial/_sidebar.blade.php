<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo-box">BC</div>
        <div class="brand-text">Benedicto College</div>
    </div>

    <nav class="side-nav">
        <a href="{{ url('/dashboard') }}" class="nav-item">
            <i class="fas fa-home"></i> Home
        </a>

        <a href="{{ url('/facilities') }}" class="nav-item {{ Request::is('facilities') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Facilities
        </a>

        <a href="{{ url('/reservation') }}" class="nav-item {{ Request::is('reservation') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i> My Reservation
        </a>
        <a href="{{ url('/calendar') }}" class="nav-item {{ Request::is('calendar') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Calendar
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>
    </div>
</aside>