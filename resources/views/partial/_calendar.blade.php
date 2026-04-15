
<div class="main-content">
    <header class="top-bar">
        <div class="header-title">
            <h2>Facility Management</h2>
            <p>Benedicto College HRMS</p>
        </div>
        <div class="header-user">
            <div class="avatar">KH</div>
        </div>
    </header>

    <div class="content-area">
        <div class="calendar-card">
            <div class="cal-header">
                <div class="cal-title">
                    <i class="fas fa-calendar-alt"></i> Reservation Calendar
                </div>
                <select class="facility-select" id="facilityFilter">
                    <option value="all">All Facilities</option>
                    <option value="room301">Room 301</option>
                    <option value="lab1">Computer Lab 1</option>
                    <option value="artist">Artist Hall</option>
                </select>
            </div>

            <div class="month-nav">
                <button class="nav-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <span class="month-label" id="monthLabel"></span>
                <button class="nav-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>

            <div class="cal-grid" id="calGrid">
                <div class="day-header">Sun</div>
                <div class="day-header">Mon</div>
                <div class="day-header">Tue</div>
                <div class="day-header">Wed</div>
                <div class="day-header">Thu</div>
                <div class="day-header">Fri</div>
                <div class="day-header">Sat</div>
            </div>

            <div class="legend">
                <div class="legend-item"><div class="legend-dot available"></div> Available</div>
                <div class="legend-item"><div class="legend-dot has-res"></div> Has Reservations</div>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle"></h3>
            <button class="modal-close" id="modalClose">&times;</button>
        </div>
        <div class="modal-body" id="modalBody"></div>
    </div>
</div>
