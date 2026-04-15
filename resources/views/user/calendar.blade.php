@extends('layout.app') @push('styles')
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endpush

@section('content')
<div class="calendar-container">
    <div class="calendar-header">
        <h2><i class="fas fa-calendar-alt"></i> Reservation Calendar</h2>
        <select id="facilityFilter">
            <option value="all">All Facilities</option>
            <option value="room301">Room 301</option>
        </select>
    </div>

    <div class="calendar-card">
        <div class="month-nav">
            <button class="nav-btn" id="prevBtn">&lt;</button>
            <span class="month-label">January 2026</span>
            <button class="nav-btn" id="nextBtn">&gt;</button>
        </div>

        <div class="cal-grid">
            <div class="day-header">Sun</div>
            <div class="day-header">Mon</div>
            <div class="day-header">Tue</div>
            <div class="day-header">Wed</div>
            <div class="day-header">Thu</div>
            <div class="day-header">Fri</div>
            <div class="day-header">Sat</div>

            <div class="day-cell empty"></div>
            <div class="day-cell">1</div>
            <div class="day-cell has-res">
                2 <span class="res-pill">3 Res</span>
            </div>
            </div>

        <div class="legend">
            <div class="legend-item"><div class="dot available"></div> Available</div>
            <div class="legend-item"><div class="dot reserved"></div> Has Reservations</div>
        </div>
    </div>
</div>
@endsection