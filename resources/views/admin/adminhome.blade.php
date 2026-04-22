@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminhome.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<section id="overview-section">
    <div class="welcome-card">
        <h2>Welcome back, Admin!</h2>
        <p>Manage facilities, approve reservations, and monitor system usage.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-info">
                <span>Total Reservations</span>
                <h3 id="total-reservations">{{ $total }}</h3> {{-- Updated --}}
            </div>
            <i class='bx bx-calendar-check'></i>
        </div>
        <div class="stat-card orange">
            <div class="stat-info">
                <span>Pending Approval</span>
                <h3 id="pending-count">{{ $pending }}</h3> {{-- Updated --}}
            </div>
            <i class='bx bx-time-five'></i>
        </div>
        <div class="stat-card green">
            <div class="stat-info">
                <span>Approved</span>
                <h3 id="approved-count">{{ $approved }}</h3> {{-- Updated --}}
            </div>
            <i class='bx bx-check-circle'></i>
        </div>
        <div class="stat-card purple">
            <div class="stat-info">
                <span>Total Facilities</span>
                <h3 id="total-facilities">{{ $totalFacilities }}</h3> {{-- Updated --}}
            </div>
            <i class='bx bx-buildings'></i>
        </div>
    </div>

    <div class="data-container">
        <h3>Pending Requests</h3>
        <p class="subtitle">Reservations awaiting your approval</p>
        <div id="pending-list">
            {{-- This loop displays real data even if JS fails to load --}}
            @forelse($pendingRequests as $req)
                <div class="request-item" style="display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid #eee;">
                    <div class="req-info">
                        <strong>{{ $req->user->name ?? 'Unknown' }}</strong>
                        <p style="margin: 0; font-size: 0.85rem; color: #666;">
                            {{ $req->room->room_number }} | {{ \Carbon\Carbon::parse($req->start_time)->format('M d, h:i A') }}
                        </p>
                    </div>
                    <div class="req-actions">
                        <a href="{{ route('admin.reservations') }}" class="btn-view" style="text-decoration: none; color: #4facfe; font-weight: 600;">Process</a>
                    </div>
                </div>
            @empty
                <p style="padding: 20px; text-align: center; color: #999;">No pending requests found.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('extra-js')
    <script src="{{ asset('adminjs/adminhome.js') }}"></script>
@endsection