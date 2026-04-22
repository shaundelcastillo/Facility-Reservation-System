// This function is now global so the button can always find it
function openLogoutModal(e) {
    if (e) e.preventDefault();
    const confirmModal = document.getElementById('confirmModal');
    if (confirmModal) {
        confirmModal.style.display = 'flex';
    } else {
        // Safe fallback: if modal is missing, just log out
        document.getElementById('logout-form').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const confirmModal = document.getElementById('confirmModal');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');
    const cancelLogout = document.getElementById('cancelLogout');

    // Confirm: Actually log out
    if (modalConfirmBtn) {
        modalConfirmBtn.addEventListener('click', function() {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.submit();
            }
        });
    }

    // Cancel: Just hide the modal
    if (cancelLogout) {
        cancelLogout.addEventListener('click', function() {
            if (confirmModal) {
                confirmModal.style.display = 'none';
            }
        });
    }

    // Close if user clicks the dark background area
    window.addEventListener('click', function(event) {
        if (event.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
    });
});