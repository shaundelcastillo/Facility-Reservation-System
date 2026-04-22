@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ time() }}">
@endpush

@section('content')
    <section class="welcome-banner">
        <div class="notification-dot"></div>
        <h1>Welcome, {{ Auth::user()->name ?? 'Student' }}</h1>
        <p>Easily book classrooms, computer labs, and other school facilities.</p>
        <a href="{{ route('facilities') }}" class="btn-browse">Browse Available Facilities</a>
    </section>

    <section class="stats-grid">
        <div class="stat-card"><h3>Total Reservations</h3><span class="num">{{ $total }}</span></div>
        <div class="stat-card"><h3>Pending</h3><span class="num">{{ $pending }}</span></div>
        <div class="stat-card"><h3>Approved</h3><span class="num">{{ $approved }}</span></div>
    </section>

    @if($recentReservation)
    <section class="panel">
        <div class="panel-header">
            <h3>Recent Reservations</h3>
            <p>Your latest booking reservation.</p>
        </div>

        <div class="res-item" id="res-{{ $recentReservation->reservation_id }}">
            <div class="res-left">
                <div>
                    <span class="res-title">{{ $recentReservation->room->room_number }}</span>
                    <span class="badge {{ $recentReservation->status }}">{{ ucfirst($recentReservation->status) }}</span>
                </div>
                <div class="res-info-grid">
                    <p><span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($recentReservation->start_time)->format('F d, Y') }}</span></p>
                    <p><span><i class="fas fa-info-circle"></i> Purpose: {{ $recentReservation->purpose }}</span></p>
                    <p><span><i class="fas fa-user"></i> Reserved by: {{ Auth::user()->name }}</span></p>
                </div>
            </div>
            <div class="res-right">
                <div class="res-time"><i class="far fa-clock"></i> 
                    <span class="time">{{ \Carbon\Carbon::parse($recentReservation->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($recentReservation->end_time)->format('h:i A') }}</span>
                </div>
                <div class="res-actions">
                    {{-- Updated to pass full data object --}}
                    <button type="button" class="btn-detail" 
                        onclick="handleView({
                            status: '{{ $recentReservation->status }}',
                            facility: '{{ $recentReservation->room->room_number }}',
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