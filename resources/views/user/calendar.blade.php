@extends('layout.calendar')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<div class="calendar-main-card">
    <div class="cal-top-bar">
        <div class="cal-title-group">
            <i class="fas fa-calendar-alt"></i> Reservation Calendar
        </div>
        {{-- Facility filter could be expanded later to filter the $reservations query --}}
        <select class="facility-dropdown" id="facilityFilter">
            <option value="all">All Facilities</option>
            <option value="room301">Room 301</option>
        </select>
    </div>

    <div class="month-selector">
        <a href="{{ route('calendar', ['month' => $date->copy()->subMonth()->format('Y-m')]) }}" class="arrow-btn" style="text-decoration:none; display:flex; align-items:center; justify-content:center;">&lt;</a>
        <span class="current-month">{{ $date->format('F Y') }}</span>
        <a href="{{ route('calendar', ['month' => $date->copy()->addMonth()->format('Y-m')]) }}" class="arrow-btn" style="text-decoration:none; display:flex; align-items:center; justify-content:center;">&gt;</a>
    </div>

    <div class="calendar-grid">
        {{-- Weekday Headers --}}
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
            <div class="day-label">{{ $dayName }}</div>
        @endforeach

        {{-- Empty Slots for the previous month's trailing days --}}
        @for($i = 0; $i < $startOfWeek; $i++)
            <div class="date-card disabled"></div>
        @endfor

        {{-- Real Days of the Month --}}
        @for($day = 1; $day <= $daysInMonth; $day++)
            <div class="date-card">
                {{ $day }}
                
                {{-- Only show real data from the database --}}
                @if(isset($reservations[$day]))
                    <span class="res-tag">
                        {{ $reservations[$day]->count() }} Res
                    </span>
                @endif
            </div>
        @endfor
    </div>

    <div class="footer-legend">
        <div class="legend-item"><div class="box-white"></div> Available</div>
        <div class="legend-item"><div class="box-green"></div> Has Reservations</div>
    </div>
</div>
@endsection