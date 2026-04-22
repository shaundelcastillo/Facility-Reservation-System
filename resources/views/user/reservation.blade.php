@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="main-container">
    <div class="blue-header-box">
        <h1>My Reservations</h1>
        <p>View and manage all your facility reservations</p>
    </div>

    <div class="reservations-list">
        @forelse($reservations as $res)
            <div class="card" id="res-{{ $res->reservation_id }}">
                <div class="card-content">
                    <div class="card-header">
                        <h2>{{ $res->room->room_number ?? 'Unknown Facility' }}</h2>
                        <span class="badge {{ strtolower($res->status) }}">{{ ucfirst($res->status) }}</span>
                    </div>
                    <div class="details">
                        <p><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($res->start_time)->format('F j, Y') }}</p>
                        <p><i class="fa-regular fa-file-lines"></i> <strong>Purpose:</strong> {{ $res->purpose ?? 'No purpose provided' }}</p>
                        <p><i class="fa-solid fa-location-dot"></i> <strong>Reserved by:</strong> {{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="time">
                        <i class="fa-regular fa-clock"></i> 
                        {{ \Carbon\Carbon::parse($res->start_time)->format('g:i A') }} - 
                        {{ \Carbon\Carbon::parse($res->end_time)->format('g:i A') }}
                    </div>
                    <div class="actions">
                        {{-- Updated to pass full data object --}}
                        <button class="btn-view" 
                            onclick="handleView({
                                status: '{{ $res->status }}',
                                facility: '{{ $res->room->room_number }}',
                                date: '{{ \Carbon\Carbon::parse($res->start_time)->format('l, F j, Y') }}',
                                time: '{{ \Carbon\Carbon::parse($res->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($res->end_time)->format('g:i A') }}',
                                user: '{{ Auth::user()->name }}',
                                purpose: '{{ addslashes($res->purpose) }}'
                            })">
                            <i class="fa-regular fa-eye"></i> View Details
                        </button>

                        <button class="btn-cancel" onclick="handleCancel('{{ $res->reservation_id }}')">
                            <i class="fa-regular fa-trash-can"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-content" style="text-align: center; padding: 40px;">
                    <p style="color: #666;">You have no reservations yet.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

@include('user.modals')
@endsection