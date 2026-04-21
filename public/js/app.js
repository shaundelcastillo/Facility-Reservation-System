'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Shared variable to store which URL we are about to delete
    let pendingDeleteUrl = "";

    // 1. GLOBAL MODAL CONTROLS
    window.closeUniModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none';
    };

    // 2. CANCELLATION LOGIC (Reflects to Database)
    window.handleCancel = function(id, deleteUrl) {
        pendingDeleteUrl = deleteUrl;
        document.getElementById('universalCancelModal').style.display = 'flex';
    };

    window.submitUniCancel = function() {
        const reason = document.getElementById('uniCancelReason').value;
        if (reason.length < 10) {
            alert('Please provide a reason at least 10 characters long.');
            return;
        }

        const form = document.getElementById('uniHiddenDeleteForm');
        form.action = pendingDeleteUrl;
        document.getElementById('uniHiddenReasonInput').value = reason;
        form.submit(); // This refreshes page and reflects in DB
    };

    // 3. VIEW DETAILS LOGIC (Matches UI image_c9e26b.png)
    window.handleView = function(data) {
        document.getElementById('det-status').textContent = data.status;
        document.getElementById('det-status').className = 'badge ' + data.status.toLowerCase();
        document.getElementById('det-facility').textContent = data.facility;
        document.getElementById('det-date').textContent = data.date;
        document.getElementById('det-time').textContent = data.time;
        document.getElementById('det-user').textContent = data.user;
        document.getElementById('det-purpose').textContent = data.purpose;
        
        document.getElementById('universalDetailsModal').style.display = 'flex';
    };

    // Keep your existing Section 1 (Leader's Facilities Logic) below this...
});