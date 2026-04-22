'use strict';

document.addEventListener('DOMContentLoaded', () => {
    let pendingDeleteUrl = "";

    // Unified Close Function for Details Modal
    window.closeUniModal = function() {
        const detailModal = document.getElementById('universalDetailsModal');
        const overlay = document.getElementById('modalOverlay');
        
        if (detailModal) detailModal.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
    };

    // Open Cancel Modal
    window.handleCancel = function(id, deleteUrl) {
        pendingDeleteUrl = deleteUrl;
        const cancelModal = document.getElementById('universalCancelModal');
        const overlay = document.getElementById('modalOverlay'); // Reusing overlay or use cancelModalOverlay if specific
        
        if (cancelModal) cancelModal.style.display = 'block';
        if (overlay) overlay.style.display = 'block';
    };

    // Close Cancel Modal (The "Keep Reservation" fix)
    window.closeCancelModal = function() {
        const cancelModal = document.getElementById('universalCancelModal');
        const overlay = document.getElementById('modalOverlay');
        const reasonInput = document.getElementById('uniCancelReason');
        
        if (cancelModal) cancelModal.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
        if (reasonInput) reasonInput.value = ''; // Reset the text
    };

    // Submit Cancellation
    window.submitUniCancel = function() {
        const reasonInput = document.getElementById('uniCancelReason');
        const reason = reasonInput ? reasonInput.value : "";
        
        if (reason.length < 10) {
            alert('Please provide a reason at least 10 characters long.');
            return;
        }

        const form = document.getElementById('uniHiddenDeleteForm');
        if (form) {
            form.action = pendingDeleteUrl;
            const hiddenReason = document.getElementById('uniHiddenReasonInput');
            if (hiddenReason) hiddenReason.value = reason;
            form.submit(); 
        }
    };

    // Handle View Details
    window.handleView = function(data) {
        // Parse if it arrives as a string
        if (typeof data === 'string') {
            try {
                data = JSON.parse(data);
            } catch (e) {
                console.error("Failed to parse reservation data", e);
                return;
            }
        }
        
        // Fill the modal fields
        const statusEl = document.getElementById('det-status');
        if (statusEl) {
            statusEl.textContent = data.status.toUpperCase();
            // This applies the .badge .rejected or .badge .approved CSS
            statusEl.className = 'badge ' + data.status.toLowerCase();
        }

        if (document.getElementById('det-facility')) document.getElementById('det-facility').textContent = data.facility;
        if (document.getElementById('det-date')) document.getElementById('det-date').textContent = data.date;
        if (document.getElementById('det-time')) document.getElementById('det-time').textContent = data.time;
        if (document.getElementById('det-user')) document.getElementById('det-user').textContent = data.user;
        if (document.getElementById('det-purpose')) document.getElementById('det-purpose').textContent = data.purpose;
        
        // Show modal and overlay
        const detailModal = document.getElementById('universalDetailsModal');
        const overlay = document.getElementById('modalOverlay');
        
        if (detailModal) detailModal.style.display = 'block';
        if (overlay) overlay.style.display = 'block';
    };
});