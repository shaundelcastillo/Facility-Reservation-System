@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ time() }}">
@endpush

@section('content')
    <section class="welcome-banner">
        <h2>Welcome, {{ Auth::user()->name ?? 'Student' }}</h2>
        <p>Easily book classrooms, computer labs, and other school facilities.</p>
        <a href="{{ route('facilities') }}" class="btn-browse">Browse Available Facilities</a>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Reservations</h3>
                <div class="stat-value">{{ $total }}</div>
            </div>
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Pending Approval</h3>
                <div class="stat-value" style="color: #ecc94b;">{{ $pending }}</div>
            </div>
            <div class="stat-icon" style="color: #ecc94b;">
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <h3>Approved</h3>
                <div class="stat-value" style="color: #48bb78;">{{ $approved }}</div>
            </div>
            <div class="stat-icon" style="color: #48bb78;">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </section>

    @if($recentReservation)
    <section class="panel">
        <div class="panel-header">
            <h3>Recent Reservation</h3>
            <p style="color: #718096; font-size: 0.9rem; margin-bottom: 20px;">Your latest booking details.</p>
        </div>

        <div class="res-item" id="res-{{ $recentReservation->reservation_id }}">
            <div class="res-left">
                <div style="margin-bottom: 10px;">
                    {{-- Changed room_number to name --}}
                    <span style="font-weight: 700; color: #2d3748; font-size: 1.1rem;">{{ $recentReservation->room->name ?? 'Unknown Facility' }}</span>
                    <span class="badge {{ $recentReservation->status }}">{{ ucfirst($recentReservation->status) }}</span>
                </div>
                <div class="res-info-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.9rem; color: #4a5568;">
                    <p><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($recentReservation->start_time)->format('F d, Y') }}</p>
                    <p><i class="fas fa-info-circle"></i> {{ $recentReservation->purpose }}</p>
                </div>
            </div>
            
            <div class="res-right" style="text-align: right;">
                <div style="margin-bottom: 15px; color: #4a5568; font-weight: 600;">
                    <i class="far fa-clock"></i> 
                    {{ \Carbon\Carbon::parse($recentReservation->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($recentReservation->end_time)->format('h:i A') }}
                </div>
                <div class="res-actions">
                    <button type="button" class="btn-detail" 
                        onclick="handleView({
                            status: '{{ $recentReservation->status }}',
                            {{-- Changed room_number to name --}}
                            facility: '{{ $recentReservation->room->name ?? 'Unknown' }}',
                            date: '{{ \Carbon\Carbon::parse($recentReservation->start_time)->format('l, F j, Y') }}',
                            time: '{{ \Carbon\Carbon::parse($recentReservation->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($recentReservation->end_time)->format('g:i A') }}',
                            user: '{{ Auth::user()->name }}',
                            purpose: '{{ addslashes($recentReservation->purpose) }}'
                        })">
                        View Details
                    </button>
                    <button type="button" class="btn-cancel" onclick="handleCancel('{{ $recentReservation->reservation_id }}')">Cancel</button>
                </div>
            </div>
        </div>
    </section>
    @endif

    @include('user.modals') 
@endsection