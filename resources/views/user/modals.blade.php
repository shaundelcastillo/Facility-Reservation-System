<div id="modalOverlay" onclick="closeUniModal()" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>

<div id="universalDetailsModal" class="details-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; border-radius:15px; z-index:1000; width:90%; max-width:450px; padding:25px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="margin:0; font-size:1.5rem;">Reservation Details</h2>
        <button onclick="closeUniModal()" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <span style="color:#666;">Status</span>
        <span id="det-status" class="badge"></span>
    </div>

    <div class="detail-section" style="margin-bottom:15px;">
        <p style="color:#666; margin-bottom:5px;"><i class="fa-solid fa-building"></i> Facility Information</p>
        <div style="display:flex; justify-content:space-between;">
            <span style="color:#999; font-size:0.9rem;">Facility Name</span>
            <strong id="det-facility"></strong>
        </div>
    </div>

    <div class="detail-section" style="margin-bottom:15px;">
        <p style="color:#666; margin-bottom:5px;"><i class="fa-regular fa-calendar"></i> Schedule</p>
        <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
            <span style="color:#999; font-size:0.9rem;">Date</span>
            <span id="det-date"></span>
        </div>
        <div style="display:flex; justify-content:space-between;">
            <span style="color:#999; font-size:0.9rem;">Time</span>
            <span id="det-time"></span>
        </div>
    </div>

    <div class="detail-section" style="margin-bottom:15px;">
        <p style="color:#666; margin-bottom:5px;"><i class="fa-regular fa-user"></i> Reservation Information</p>
        <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
            <span style="color:#999; font-size:0.9rem;">Reserved By</span>
            <span id="det-user"></span>
        </div>
    </div>

    <div class="detail-section" style="margin-bottom:15px;">
        <p style="color:#666; margin-bottom:5px;"><i class="fa-regular fa-file-lines"></i> Purpose</p>
        <p id="det-purpose" style="margin:0; font-size:0.95rem;"></p>
    </div>
</div>

<div id="universalCancelModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; border-radius:15px; z-index:1000; width:90%; max-width:400px; padding:30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">
    <h2 style="margin-bottom: 10px;">Cancel Reservation</h2>
    <p style="color: #666; margin-bottom: 20px;">Please provide a reason for cancelling this reservation.</p>
    
    <textarea id="uniCancelReason" placeholder="Reason for cancellation..." style="width: 100%; height: 100px; padding: 10px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 20px; font-family: inherit; resize: none;"></textarea>

    <div style="display: flex; gap: 10px; justify-content: center;">
        <button type="button" onclick="closeCancelModal()" style="background: #edf2f7; color: #4a5568; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
            Keep Reservation
        </button>
        <button type="button" onclick="submitUniCancel()" style="background: #f56565; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
            Cancel Reservation
        </button>
    </div>
</div>

<form id="uniHiddenDeleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="reason" id="uniHiddenReasonInput">
</form>