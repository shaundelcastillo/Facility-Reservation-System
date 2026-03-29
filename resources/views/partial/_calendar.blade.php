<div class="calendar-card">

        {{-- Top bar --}}
        <div class="cal-header">
            <div class="cal-title">
                <i class="fas fa-calendar-check"></i>
                Reservation Calendar
            </div>
            <select class="facility-select" id="facilityFilter">
                <option value="all">All Facilities</option>
                <option value="room301">Room 301</option>
                <option value="room309">Room 309</option>
                <option value="room308">Room 308</option>
                <option value="lab1">Computer Lab 1</option>
                <option value="lab2">Computer Lab 2</option>
                <option value="artist">Artist Hall</option>
                <option value="genetics">Genetics</option>
                <option value="library">Library</option>
                <option value="amphitheater">Amphitheater</option>
                <option value="study1">Study Room 1</option>
                <option value="study2">Study Room 2</option>
            </select>
        </div>

        {{-- Month navigation --}}
        <div class="month-nav">
            <button class="nav-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
            <span class="month-label" id="monthLabel"></span>
            <button class="nav-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
        </div>

        {{-- Calendar grid --}}
        <div class="cal-grid" id="calGrid">
            <div class="day-header">Sun</div>
            <div class="day-header">Mon</div>
            <div class="day-header">Tue</div>
            <div class="day-header">Wed</div>
            <div class="day-header">Thu</div>
            <div class="day-header">Fri</div>
            <div class="day-header">Sat</div>
        </div>

        {{-- Legend --}}
        <div class="legend">
            <div class="legend-item">
                <div class="legend-dot available"></div> Available
            </div>
            <div class="legend-item">
                <div class="legend-dot has-res"></div> Has Reservations
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/calendar.js') }}"></script>
@endpush