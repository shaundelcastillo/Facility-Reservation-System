document.addEventListener('DOMContentLoaded', function() {
    
    /* ============================================================
       SECTION 1: TEAM LEADER'S FACILITIES LOGIC
       ============================================================ */
    const bookingModal = document.getElementById('bookingModal');
    const bookingModalTitle = document.getElementById('modalTitle');
    const closeBookingBtn = document.getElementById('closeModal');
    const bookButtons = document.querySelectorAll('.book-btn');

    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const facilityCards = document.querySelectorAll('.facility-card');

    // Only run if book buttons exist (Facilities Page)
    if (bookButtons.length > 0) {
        bookButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const card = btn.closest('.facility-card');
                const facilityName = card.getAttribute('data-name');
                if(bookingModalTitle) bookingModalTitle.innerText = "Book " + facilityName;
                if(bookingModal) bookingModal.style.display = "flex";
            });
        });
    }

    if (closeBookingBtn && bookingModal) {
        closeBookingBtn.addEventListener('click', () => bookingModal.style.display = "none");
    }

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const filterValue = searchInput.value.toLowerCase();
            facilityCards.forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.indexOf(filterValue) > -1 ? "block" : "none";
            });
        });
    }

    if (filterButtons.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const selectedType = btn.getAttribute('data-type');
                facilityCards.forEach(card => {
                    card.style.display = (selectedType === 'all' || card.classList.contains(selectedType)) ? "block" : "none";
                });
            });
        });
    }


    /* ============================================================
       SECTION 2: KRISZYLE'S CALENDAR LOGIC
       ============================================================ */
    const calGrid = document.getElementById('calGrid');

    // Only run if the calendar grid exists (Calendar Page)
    if (calGrid) {
        const reservations = {
            '2026-01-18': [
                { facility: 'Computer Lab 1', facilityKey: 'lab1', time: '9:00 AM – 11:00 AM', purpose: 'Web Development Workshop', reservedBy: 'Juan Dela Cruz (IT)', status: 'approved' },
                { facility: 'Study Room 1', facilityKey: 'study1', time: '1:00 PM – 3:00 PM', purpose: 'Group Study Session', reservedBy: 'Carlos Mendiola (CS)', status: 'approved' },
            ],
            '2026-01-20': [
                { facility: 'Artist Hall', facilityKey: 'artist', time: '2:00 PM – 5:00 PM', purpose: 'IT Symposium 2026', reservedBy: 'Maria Santos (IT)', status: 'pending' },
            ],
            '2026-01-22': [
                { facility: 'Amphitheater', facilityKey: 'amphitheater', time: '10:00 AM – 12:00 PM', purpose: 'Thesis Defense', reservedBy: 'Pablo Garcia (IT)', status: 'approved' },
                { facility: 'Computer Lab 2', facilityKey: 'lab2', time: '3:00 PM – 5:00 PM', purpose: 'Student Org Meeting', reservedBy: 'Anna Reyes (IT)', status: 'approved' },
            ],
            '2026-01-23': [
                { facility: 'Computer Lab 2', facilityKey: 'lab2', time: '1:00 PM – 3:00 PM', purpose: 'Software Engineering Lab', reservedBy: 'Leo Reyes (IT)', status: 'approved' },
            ],
            '2026-01-25': [
                { facility: 'Library', facilityKey: 'library', time: '8:00 AM – 10:00 AM', purpose: 'Research Study', reservedBy: 'Nina Cruz (CS)', status: 'approved' },
            ],
            '2026-01-28': [
                { facility: 'Room 301', facilityKey: 'room301', time: '9:00 AM – 11:00 AM', purpose: 'Faculty Meeting', reservedBy: 'Prof. Santos', status: 'approved' },
            ],
            '2026-02-03': [
                { facility: 'Genetics', facilityKey: 'genetics', time: '1:00 PM – 3:00 PM', purpose: 'Biology Lab Session', reservedBy: 'Kim Alvarez (Bio)', status: 'approved' },
            ],
            '2026-02-10': [
                { facility: 'Study Room 2', facilityKey: 'study2', time: '3:00 PM – 5:00 PM', purpose: 'Thesis Consultation', reservedBy: 'Marco Diaz (IT)', status: 'pending' },
                { facility: 'Computer Lab 1', facilityKey: 'lab1', time: '8:00 AM – 10:00 AM', purpose: 'Web Systems Class', reservedBy: 'Prof. Reyes', status: 'approved' },
            ],
        };

        const MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        let current = new Date(2026, 0, 1);
        let activeFilter = 'all';

        const pad = n => String(n).padStart(2, '0');
        const dateKey = (y, m, d) => `${y}-${pad(m + 1)}-${pad(d)}`;

        function getFiltered(key) {
            const entries = reservations[key] || [];
            return activeFilter === 'all' ? entries : entries.filter(r => r.facilityKey === activeFilter);
        }

        function buildCalendar() {
            const headers = [...calGrid.querySelectorAll('.day-header')];
            calGrid.innerHTML = '';
            headers.forEach(h => calGrid.appendChild(h));

            const monthLabel = document.getElementById('monthLabel');
            if(monthLabel) monthLabel.textContent = `${MONTHS[current.getMonth()]} ${current.getFullYear()}`;

            const y = current.getFullYear(), m = current.getMonth();
            const firstDay = new Date(y, m, 1).getDay();
            const daysInMonth = new Date(y, m + 1, 0).getDate();
            const today = new Date();

            for (let i = 0; i < firstDay; i++) {
                const empty = document.createElement('div');
                empty.className = 'day-cell empty';
                calGrid.appendChild(empty);
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const key = dateKey(y, m, d);
                const entries = getFiltered(key);
                const hasRes = entries.length > 0;
                const isToday = today.getFullYear() === y && today.getMonth() === m && today.getDate() === d;

                const cell = document.createElement('div');
                cell.className = ['day-cell', hasRes ? 'has-reservations' : '', isToday ? 'today' : ''].filter(Boolean).join(' ');

                const num = document.createElement('div');
                num.className = 'day-num';
                num.textContent = d;
                cell.appendChild(num);

                if (hasRes) {
                    entries.forEach(r => {
                        const pill = document.createElement('div');
                        pill.className = 'res-pill';
                        pill.textContent = r.time;
                        cell.appendChild(pill);
                    });
                    cell.addEventListener('click', () => openCalendarModal(key, y, m, d));
                }
                calGrid.appendChild(cell);
            }
        }

        function openCalendarModal(key, y, m, d) {
            const entries = getFiltered(key);
            const title = document.getElementById('modalTitle');
            const body = document.getElementById('modalBody');
            const overlay = document.getElementById('modalOverlay');

            if(title) title.textContent = `${MONTHS[m]} ${d}, ${y}`;
            if(body) {
                body.innerHTML = entries.length === 0 ? '<p class="modal-empty">No reservations.</p>' : '';
                entries.forEach(r => {
                    const item = document.createElement('div');
                    item.className = 'modal-res-item';
                    item.innerHTML = `
                        <div class="modal-res-info">
                            <div class="modal-res-facility">${r.facility}</div>
                            <div class="modal-res-time"><i class="far fa-clock"></i> ${r.time}</div>
                            <div class="modal-res-detail">${r.purpose}</div>
                            <div class="modal-res-detail"><strong>By:</strong> ${r.reservedBy}</div>
                        </div>
                        <span class="modal-badge ${r.status}">${r.status}</span>
                    `;
                    body.appendChild(item);
                });
            }
            if(overlay) overlay.classList.add('open');
        }

        // Calendar Listeners
        document.getElementById('prevBtn')?.addEventListener('click', () => { current.setMonth(current.getMonth() - 1); buildCalendar(); });
        document.getElementById('nextBtn')?.addEventListener('click', () => { current.setMonth(current.getMonth() + 1); buildCalendar(); });
        document.getElementById('facilityFilter')?.addEventListener('change', e => { activeFilter = e.target.value; buildCalendar(); });
        document.getElementById('modalClose')?.addEventListener('click', () => document.getElementById('modalOverlay').classList.remove('open'));
        
        document.getElementById('modalOverlay')?.addEventListener('click', e => {
            if (e.target === e.currentTarget) e.target.classList.remove('open');
        });

        buildCalendar();
    }
});