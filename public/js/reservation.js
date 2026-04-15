'use strict';

// Shared variable for cancellation
let currentCancelTarget = null;

// Function to handle showing details
window.showViewModal = function(facilityName) {
    const overlay = document.getElementById('viewOverlay');
    const facilityDisplay = document.getElementById('v-facility');
    
    // In a real app, you'd fetch data here. For now, we populate the name.
    if(facilityDisplay) facilityDisplay.textContent = facilityName;
    
    if(overlay) overlay.classList.add('active');
};

// Function to handle showing cancel confirmation
window.showCancelModal = function(facilityName) {
    const overlay = document.getElementById('cancelOverlay');
    const facilityDisplay = document.getElementById('c-facility');
    
    currentCancelTarget = facilityName;
    if(facilityDisplay) facilityDisplay.textContent = facilityName;
    
    if(overlay) overlay.classList.add('active');
};

// Global close function
window.closeAll = function() {
    document.getElementById('viewOverlay').classList.remove('active');
    document.getElementById('cancelOverlay').classList.remove('active');
};

// Confirm Cancellation
window.confirmCancel = function() {
    alert("Reservation for " + currentCancelTarget + " has been cancelled.");
    window.closeAll();
    // Logic to refresh list or remove card would go here
};

document.addEventListener('DOMContentLoaded', () => {
    // Any extra initialization logic for the reservations page
});