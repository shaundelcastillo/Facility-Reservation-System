document.addEventListener('DOMContentLoaded', () => {
    fetchDashboardData();

    // Hook up the Logout button in the header
    const logoutBtn = document.querySelector('.btn-logout');
    if (logoutBtn) {
        logoutBtn.onclick = handleLogout;
    }

    // NEW: Hook up the Cancel button inside the modal
    const cancelBtn = document.getElementById('cancelLogout');
    if (cancelBtn) {
        cancelBtn.onclick = closeConfirmModal;
    }
});

// --- DATA FETCHING (Kept Original) ---

async function fetchDashboardData() {
    try {
        const response = await fetch('/admin/api/dashboard-data');
        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();

        // Update the Stats Cards
        document.getElementById('total-reservations').innerText = data.total;
        document.getElementById('pending-count').innerText = data.pending_count;
        document.getElementById('approved-count').innerText = data.approved;
        document.getElementById('total-facilities').innerText = data.facilities_count;
        
        renderPendingList(data.pending_list);
    } catch (error) {
        console.error("Error fetching dashboard data:", error);
    }
}

function renderPendingList(requests) {
    const listContainer = document.getElementById('pending-list');
    
    if (!requests || requests.length === 0) {
        listContainer.innerHTML = "<p>No pending requests at this time.</p>";
        return;
    }

    listContainer.innerHTML = requests.map(req => `
        <div class="request-item" id="request-${req.id}">
            <div class="info">
                <strong>${req.facility.name}</strong>
                <p style="font-size: 13px; color: #666;">
                    ${req.user.name} • ${req.reservation_date} • ${req.start_time} - ${req.end_time}
                </p>
            </div>
            <div class="actions">
                <button class="btn-approve" onclick="handleAction(${req.id}, 'approved', '${req.facility.name}')">
                    <i class='bx bx-check-circle'></i> Approve
                </button>
                <button class="btn-reject" onclick="handleAction(${req.id}, 'rejected', '${req.facility.name}')">
                    <i class='bx bx-x-circle'></i> Reject
                </button>
            </div>
        </div>
    `).join('');
}

// --- ACTIONS & MODAL LOGIC ---

const confirmModal = document.getElementById('confirmModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const modalConfirmBtn = document.getElementById('modalConfirmBtn');

function openConfirmModal(title, message, onConfirm, isDanger = false) {
    modalTitle.innerText = title;
    modalMessage.innerHTML = message;
    confirmModal.style.display = 'flex';
    
    modalConfirmBtn.style.background = isDanger ? '#2ecc71' : '#ff5e5e';

    modalConfirmBtn.onclick = async () => {
        await onConfirm();
        // Don't close immediately if we are logging out, the redirect will handle it
        if (!isDanger || title !== "Logout") {
            closeConfirmModal();
        }
    };
}

function closeConfirmModal() {
    confirmModal.style.display = 'none';
}

async function handleAction(id, type, facilityName) {
    const title = `${type.charAt(0).toUpperCase() + type.slice(1)} Reservation`;
    const message = `Are you sure you want to ${type} this reservation for <strong>${facilityName}</strong>?`;
    
    openConfirmModal(title, message, async () => {
        try {
            const response = await fetch('/admin/api/update-status', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
                },
                body: JSON.stringify({ id: id, status: type })
            });

            if (response.ok) {
                fetchDashboardData(); 
            }
        } catch (error) {
            console.error("Action failed:", error);
        }
    }, type === 'rejected');
}

// UPDATED: handleLogout to submit the form correctly
function handleLogout() {
    openConfirmModal(
        "Logout", 
        "Are you sure you want to log out of the system?", 
        () => { 
            // This triggers the hidden form in your admin.blade.php
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.submit();
            } else {
                // Fallback if form is missing
                window.location.href = '/login'; 
            }
        }, 
        true
    );
}

// Close modal if clicking outside the box (Using addEventListener for better stability)
window.addEventListener('click', (event) => {
    if (event.target == confirmModal) {
        closeConfirmModal();
    }
});