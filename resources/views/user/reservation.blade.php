<div class="reservation-page">
    <div class="header">
        <h1>My Reservations</h1>
        <p>View and manage all your facility reservations</p>
    </div>

    <div class="nav-tabs">
        <a href="{{ url('/facilities') }}" class="nav-tab">Facilities</a>
        <a href="{{ url('/my-reservations') }}" class="nav-tab active">My Reservations</a>
        <a href="{{ url('/calendar') }}" class="nav-tab">Calendar</a>
    </div>

    <div class="main reservation-container" id="reservationList">
        
        <div class="card">
            <div class="card-content-left">
                <div class="title-row">
                    <span class="facility-title">Computer Lab 1</span>
                    <span class="badge-approved">Approved</span>
                </div>
                <div class="info-details">
                    <p>📅 January 20, 2026</p>
                    <p>📄 <strong>Purpose:</strong> Web Development Workshop</p>
                    <p>📍 <strong>Reserved by:</strong> Juan Dela Cruz (Information Technology)</p>
                </div>
            </div>
            <div class="card-content-right">
                <div class="time-stamp">
                    🕒 9:00 AM - 11:00 AM
                </div>
                <div class="action-group">
                    <button class="btn-action btn-view" onclick="showViewModal('Computer Lab 1')">View Details</button>
                    <button class="btn-action btn-cancel" onclick="showCancelModal('Computer Lab 1')">Cancel</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content-left">
                <div class="title-row">
                    <span class="facility-title">Artist Hall</span>
                    <span class="badge-pending">Pending</span>
                </div>
                <div class="info-details">
                    <p>📅 January 25, 2026</p>
                    <p>📄 <strong>Purpose:</strong> IT Symposium 2026</p>
                    <p>📍 <strong>Reserved by:</strong> Maria Santos (Information Technology)</p>
                </div>
            </div>
            <div class="card-content-right">
                <div class="time-stamp">
                    🕒 2:00 PM - 5:00 PM
                </div>
                <div class="action-group">
                    <button class="btn-action btn-view" onclick="showViewModal('Artist Hall')">View Details</button>
                    <button class="btn-action btn-cancel" onclick="showCancelModal('Artist Hall')">Cancel</button>
                </div>
            </div>
        </div>

    </div>

    <div class="overlay" id="viewOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title">Reservation Details</span>
                <button class="modal-close" onclick="window.closeAll()">✕</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <div class="detail-icon">🏢</div>
                    <div>
                        <div class="detail-label">Facility</div>
                        <div class="detail-value" id="v-facility"></div>
                    </div>
                    <div style="margin-left:auto" id="v-badge"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon">📅</div>
                    <div>
                        <div class="detail-label">Date & Time</div>
                        <div class="detail-value" id="v-datetime"></div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-icon">🎯</div>
                    <div>
                        <div class="detail-label">Purpose</div>
                        <div class="detail-value" id="v-purpose"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-action btn-view" onclick="window.closeAll()">Close</button>
            </div>
        </div>
    </div>

    <div class="overlay" id="cancelOverlay">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title">Cancel Reservation</span>
                <button class="modal-close" onclick="window.closeAll()">✕</button>
            </div>
            <div class="modal-body">
                <div class="cancel-warning">
                    ⚠️ Are you sure you want to cancel this reservation for 
                    <strong id="c-facility"></strong>? This action cannot be undone.
                </div>
                <div class="cancel-label">Reason for cancellation (optional)</div>
                <textarea class="cancel-reason" id="cancelReason" rows="3" placeholder="Enter reason..."></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn-action btn-view" onclick="window.closeAll()">Keep Reservation</button>
                <button class="btn-action btn-cancel" onclick="window.confirmCancel()">Cancel Reservation</button>
            </div>
        </div>
    </div>
</div>