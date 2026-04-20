@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <section class="welcome-banner">
        <div class="notification-dot"></div>
        <h1>Welcome, {{ Auth::user()->name ?? 'Student' }}</h1>
        <p>Easily book classrooms, computer labs, and other school facilities.</p>
        {{-- Fixed Button with Link --}}
        <a href="{{ route('facilities') }}" class="btn-browse">Browse Available Facilities</a>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total Reservations</h3>
            <span class="num">{{ $total }}</span>
        </div>
        <div class="stat-card">
            <h3>Pending</h3>
            <span class="num">{{ $pending }}</span>
        </div>
        <div class="stat-card">
            <h3>Approved</h3>
            <span class="num">{{ $approved }}</span>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h3>Quick Actions</h3>
            <p>Get started with these common tasks</p>
        </div>
        <div class="action-grid">
            <a href="{{ route('facilities') }}" class="action-card">
                <i class="fas fa-building"></i>
                <h4>Book a facility</h4>
                <p>Browse and reserve available rooms</p>
            </a>
            <a href="{{ route('reservation') }}" class="action-card">
                <i class="fas fa-clipboard-list"></i>
                <h4>View my reservation</h4>
                <p>Manage your reservation</p>
            </a>
            <a href="{{ route('calendar') }}" class="action-card">
                <i class="fas fa-calendar-check"></i>
                <h4>Check your calendar</h4>
                <p>View availability schedule</p>
            </a>
        </div>
    </section>

    {{-- Only show if real data exists --}}
    @if($recent)
    <section class="panel">
        <div class="panel-header">
            <h3>Recent Reservations</h3>
            <p>Your latest booking reservation.</p>
        </div>

        <div class="res-item">
            <div class="res-left">
                <div>
                    <span class="res-title">{{ $recent->room->room_number }}</span>
                    <span class="badge {{ $recent->status }}">{{ ucfirst($recent->status) }}</span>
                </div>
                <div class="res-info-grid">
                    <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($recent->start_time)->format('F d, Y') }}</span>
                    <span><i class="fas fa-info-circle"></i> Purpose: {{ $recent->purpose }}</span>
                    <span><i class="fas fa-user"></i> Reserved by: {{ Auth::user()->name }}</span>
                </div>
            </div>
            <div class="res-right">
                <div class="res-time"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($recent->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($recent->end_time)->format('h:i A') }}</div>
                <div class="res-actions">
                    <a href="{{ route('reservation') }}" class="btn-detail">View Details</a>
                    {{-- Standard form for delete --}}
                    <form action="{{ route('reservation.destroy', $recent->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancel">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-center">
            <a href="{{ route('reservation') }}" class="btn-view-all">View All Reservations</a>
        </div>
    </section>
    @endif
@endsection