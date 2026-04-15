'use strict';

document.addEventListener('DOMContentLoaded', () => {

    /* =============================================================
       SECTION 1: LEADER'S FACILITIES LOGIC
       ============================================================= */
    const bookingModal = document.getElementById('bookingModal');
    if (bookingModal) {
        const modalTitle = document.getElementById('modalTitle');
        const closeModalBtn = document.getElementById('closeModal');
        const bookButtons = document.querySelectorAll('.book-btn');
        const searchInput = document.getElementById('searchInput');ac
        const filterButtons = document.querySelectorAll('.filter-btn');
        const facilityCards = document.querySelectorAll('.facility-card');

        bookButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.facility-card');
                const facilityName = card.getAttribute('data-name');
                modalTitle.innerText = "Book " + facilityName;
                bookingModal.style.display = "flex";
            });
        });

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                bookingModal.style.display = "none";
            });
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const filterValue = searchInput.value.toLowerCase();
                facilityCards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    card.style.display = text.indexOf(filterValue) > -1 ? "block" : "none";
                });
            });
        }

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const selectedType = btn.getAttribute('data-type');
                facilityCards.forEach(card => {
                    card.style.display = (selectedType === 'all' || card.classList.contains(selectedType)) ? "block" : "none";
                });
            });
        });
    }

    /* =============================================================
       SECTION 2: KRISZYLE'S RESERVATIONS LOGIC
       ============================================================= */
    const reservationList = document.getElementById('reservationList');
    if (reservationList) {
        // Data
        const reservations = [
            { id: 1, facility: 'Computer Lab 1', status: 'approved', date: 'January 20, 2026', purpose: 'Web Development Workshop', person: 'Juan Dela Cruz (IT)', time: '9:00 AM – 11:00 AM' },
            { id: 2, facility: 'Artist Hall', status: 'pending', date: 'January 25, 2026', purpose: 'IT Symposium 2026', person: 'Maria Santos (IT)', time: '1:00 PM – 5:00 PM' },
            { id: 3, facility: 'Amphitheater', status: 'approved', date: 'January 31, 2026', purpose: 'Thesis Defense', person: 'Pedro Garcia (IT)', time: '10:00 AM – 12:30 PM' }
        ];

        let cancelTarget = null;

        // Functions
        const renderList = () => {
            const active = reservations.filter(r => r.status !== 'cancelled');
            if (!active.length) {
                reservationList.innerHTML = `<div class="empty"><h3>No reservations yet</h3></div>`;
                return;
            }

            reservationList.innerHTML = active.map(r => `
                <div class="card" id="card-${r.id}">
                    <div class="card-header">
                        <span class="card-title">${r.facility}</span>
                        ${badgeHtml(r.status)}
                    </div>
                    <div class="card-meta">
                        <span>📅 ${r.date}</span>
                        <span class="time">🕒 ${r.time}</span>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-outline" onclick="window.viewDetails(${r.id})">View Details</button>
                        <button class="btn btn-danger" onclick="window.openCancel(${r.id})">Cancel</button>
                    </div>
                </div>
            `).join('');
        };

        const badgeHtml = (status) => {
            const map = { approved: ['badge-approved', 'Approved'], pending: ['badge-pending', 'Pending'] };
            const [cls, label] = map[status] ?? ['badge-cancelled', 'Cancelled'];
            return `<span class="badge ${cls}">${label}</span>`;
        };

        // Expose functions to global window so HTML onclick works
        window.viewDetails = (id) => {
            const r = reservations.find(x => x.id === id);
            document.getElementById('v-facility').textContent = r.facility;
            document.getElementById('v-datetime').textContent = `${r.date} | ${r.time}`;
            document.getElementById('viewOverlay').classList.add('active');
        };

        window.openCancel = (id) => {
            cancelTarget = id;
            const r = reservations.find(x => x.id === id);
            document.getElementById('c-facility').textContent = r.facility;
            document.getElementById('cancelOverlay').classList.add('active');
        };

        window.closeAll = () => {
            document.getElementById('viewOverlay').classList.remove('active');
            document.getElementById('cancelOverlay').classList.remove('active');
        };

        window.confirmCancel = () => {
            const idx = reservations.findIndex(x => x.id === cancelTarget);
            if (idx > -1) reservations[idx].status = 'cancelled';
            window.closeAll();
            renderList();
        };

        renderList();
    }
});