@extends('layout.app')

{{-- Add this block to link your CSS --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <section class="welcome-banner">
        <div class="notification-dot"></div>
        <h1>Welcome, Juan Dela Cruz</h1>
        <p>Easily book classrooms, computer labs, conference rooms, and other school facilities for your activities and events.</p>
        <button class="btn-browse">Browse Available Facilities</button>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total Reservations</h3>
            <span class="num">5</span>
        </div>
        <div class="stat-card">
            <h3>Pending</h3>
            <span class="num">1</span>
        </div>
        <div class="stat-card">
            <h3>Approved</h3>
            <span class="num">4</span>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h3>Quick Actions</h3>
            <p>Get started with these common tasks</p>
        </div>
        <div class="action-grid">
            <div class="action-card">
                <i class="fas fa-building"></i>
                <h4>Book a facility</h4>
                <p>Browse and reserve available rooms</p>
            </div>
            <div class="action-card">
                <i class="fas fa-clipboard-list"></i>
                <h4>View my reservation</h4>
                <p>Manage your reservation</p>
            </div>
            <div class="action-card">
                <i class="fas fa-calendar-check"></i>
                <h4>Check your calendar</h4>
                <p>View availability schedule</p>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header">
            <h3>Recent Reservations</h3>
            <p>Your latest booking reservation.</p>
        </div>

        <div class="res-item">
            <div class="res-left">
                <div>
                    <span class="res-title">Computer Lab 1</span>
                    <span class="badge approved">Approved</span>
                </div>
                <div class="res-info-grid">
                    <span><i class="far fa-calendar-alt"></i> September 11, 2026</span>
                    <span><i class="fas fa-info-circle"></i> Purpose: Web Development</span>
                    <span><i class="fas fa-user"></i> Reserved by: Hugo Villa (IT)</span>
                </div>
            </div>
            <div class="res-right">
                <div class="res-time"><i class="far fa-clock"></i> 9:00 AM - 11:00 AM</div>
                <div class="res-actions">
                    <button><i class="far fa-eye"></i> View Details</button>
                    <button class="btn-cancel"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </div>
        </div>

        <div class="footer-center">
            <button class="btn-view-all">View All Reservations</button>
        </div>
    </section>
@endsection