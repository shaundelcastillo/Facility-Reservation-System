<aside class="sidebar">
    <div class="sidebar-brand">
    <div class="logo-box">
        <img src="{{ asset('https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/380790490_810610521073768_1413158087196732061_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=1d70fc&_nc_eui2=AeGevFTcyEEg8FLGksLW7tfTjRg-_uuZFZaNGD7-65kVliRyjXxY9EBA6fdLY3Sse2cl7Rr7XKRfrgnlO7BXAlKk&_nc_ohc=BEbMybC7YaoQ7kNvwFs2Xgt&_nc_oc=AdrDjaS_4FnAUAWdnWHNQ8PuNg3m5tq_2lZjB81kVTTlS949nfcckFaQ3KL31IaiViQ&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=5sme3GwOATBZqgDoZGYyJA&_nc_ss=7a2a8&oh=00_Af18jYM64aY1dFta-gIkhkL5ZgsmPZVadcsVSEy3MABGxg&oe=69EED510') }}" alt="BC Logo" class="brand-logo">
    </div>
    <div class="brand-text">Benedicto College</div>
</div>
    <nav class="side-nav">
        <a href="{{ url('/dashboard') }}" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
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
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>