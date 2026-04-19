@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminhome.css') }}">
    {{-- CRITICAL: This allows JS to talk to Laravel safely --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<section id="overview-section">
    <div class="welcome-card">
        <h2>Welcome back, Admin User!</h2>
        <p>Manage facilities, approve reservations, and monitor system usage.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-info">
                <span>Total Reservations</span>
                <h3 id="total-reservations">0</h3> {{-- Added ID --}}
            </div>
            <i class='bx bx-calendar-check'></i>
        </div>
        <div class="stat-card orange">
            <div class="stat-info">
                <span>Pending Approval</span>
                <h3 id="pending-count">0</h3> {{-- Existing ID --}}
            </div>
            <i class='bx bx-time-five'></i>
        </div>
        <div class="stat-card green">
            <div class="stat-info">
                <span>Approved</span>
                <h3 id="approved-count">0</h3> {{-- Added ID --}}
            </div>
            <i class='bx bx-check-circle'></i>
        </div>
        <div class="stat-card purple">
            <div class="stat-info">
                <span>Total Facilities</span>
                <h3 id="total-facilities">0</h3> {{-- Added ID --}}
            </div>
            <i class='bx bx-buildings'></i>
        </div>
    </div>

    <div class="data-container">
        <h3>Pending Request</h3>
        <p class="subtitle">Reservations awaiting your approval</p>
        <div id="pending-list">
            {{-- JS will inject requests here --}}
        </div>
    </div>
</section>
@endsection

@section('extra-js')
    {{-- Ensure the path matches your folder structure: adminjs/adminhome.js --}}
    <script src="{{ asset('adminjs/adminhome.js') }}"></script>
@endsection