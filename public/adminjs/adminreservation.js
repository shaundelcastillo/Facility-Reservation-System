const reservations = [
    { id: 101, user: "Juan Dela Cruz", facility: "Computer Lab 1", date: "2026-01-20", time: "09:00 - 11:00", purpose: "Web Development Workshop", status: "approved" },
    { id: 102, user: "Maria Santos", facility: "Artist Hall", date: "2026-01-25", time: "14:00 - 17:00", purpose: "IT Symposium 2026", status: "pending" },
    { id: 103, user: "Pedro Garcia", facility: "Amphitheater", date: "2026-01-18", time: "10:00 - 12:00", purpose: "Thesis Defense", status: "approved" },
    { id: 104, user: "Anna Reyes", facility: "Computer Lab 2", date: "2026-01-23", time: "13:00 - 15:00", purpose: "Student Organization Meeting", status: "pending" },
    { id: 105, user: "Carlos Mendoza", facility: "Study Room 1", date: "2026-01-22", time: "15:00 - 17:00", purpose: "Group Study Session", status: "pending" }
];

document.addEventListener('DOMContentLoaded', () => {
    renderTable();

    // Hook up the Logout button in header
    const logoutBtn = document.querySelector('.btn-logout');
    if (logoutBtn) {
        logoutBtn.onclick = () => {
            openConfirmModal(
                "Logout", 
                "Are you sure you want to log out?", 
                () => { 
                    // This triggers the actual Laravel logout form
                    const logoutForm = document.getElementById('logout-form');
                    if (logoutForm) logoutForm.submit();
                }, 
                true
            );
        };
    }

    // Hook up the Cancel button (Fixes the "not canceling" problem)
    const cancelBtn = document.getElementById('cancelLogout');
    if (cancelBtn) {
        cancelBtn.onclick = closeConfirmModal;
    }
});

function renderTable() {
    const tbody = document.getElementById('reservation-tbody');
    if (!tbody) return;
    
    tbody.innerHTML = reservations.map(res => `
        <tr>
            <td>${res.user}</td>
            <td>${res.facility}</td>
            <td>${res.date}</td>
            <td>${res.time}</td>
            <td>${res.purpose}</td>
            <td><span class="status-pill ${res.status}">${res.status}</span></td>
            <td>
                ${res.status === 'pending' ? `
                    <i class='bx bx-check-square action-icon icon-approve' title="Approve" onclick="updateStatus(${res.id}, 'approved')"></i>
                    <i class='bx bx-x-circle action-icon icon-reject' title="Reject" onclick="updateStatus(${res.id}, 'rejected')"></i>
                ` : '<span style="color:#ccc">--</span>'}
            </td>
        </tr>
    `).join('');
}

const confirmModal = document.getElementById('confirmModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const modalConfirmBtn = document.getElementById('modalConfirmBtn');

function openConfirmModal(title, message, onConfirm, isDanger = false) {
    modalTitle.innerText = title;
    modalMessage.innerHTML = message;
    confirmModal.style.display = 'flex';
    
    // UI feedback: Red for logout/reject, Green for confirm
    modalConfirmBtn.style.background = isDanger ? '#2ecc71' : '#ff5e5e';

    modalConfirmBtn.onclick = () => {
        onConfirm();
        if (title !== "Logout") {
            closeConfirmModal();
        }
    };
}

function closeConfirmModal() {
    confirmModal.style.display = 'none';
}

function updateStatus(id, newStatus) {
    const res = reservations.find(r => r.id === id);
    if (!res) return;

    const actionText = newStatus === 'approved' ? 'Approve' : 'Reject';
    const message = `Are you sure you want to ${actionText.toLowerCase()} the reservation for <strong>${res.facility}</strong> by ${res.user}?`;

    openConfirmModal(
        `${actionText} Reservation`,
        message,
        () => {
            res.status = newStatus;
            renderTable();
        },
        newStatus === 'rejected'
    );
}

// Close modal when clicking outside the box
window.addEventListener('click', (event) => {
    if (event.target == confirmModal) {
        closeConfirmModal();
    }
});