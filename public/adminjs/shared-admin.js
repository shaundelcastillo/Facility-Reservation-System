document.addEventListener('DOMContentLoaded', function() {
    const confirmModal = document.getElementById('confirmModal');
    const logoutBtn = document.getElementById('logoutBtn');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');
    const cancelLogout = document.getElementById('cancelLogout');

    // 1. Open the Modal when Logout is clicked
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirmModal) {
                confirmModal.style.display = 'flex';
            }
        });
    }

    // 2. Confirm: Actually log out
    if (modalConfirmBtn) {
        modalConfirmBtn.addEventListener('click', function() {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.submit();
            }
        });
    }

    // 3. Cancel: Just hide the modal
    if (cancelLogout) {
        cancelLogout.addEventListener('click', function() {
            if (confirmModal) {
                confirmModal.style.display = 'none';
            }
        });
    }

    // 4. Close if user clicks the dark background area
    window.addEventListener('click', function(event) {
        if (event.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
    });
});