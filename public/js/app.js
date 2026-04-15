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
    
    
    if (calGrid) {
        let currentDisplayDate = new Date(2026, 3, 1); // April 2026
        let selectedFacility = 'all';
        const MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        function renderCalendar() {
            // Keep the day-headers (Sun, Mon, etc.)
            const headers = [...calGrid.querySelectorAll('.day-header')];
            calGrid.innerHTML = '';
            headers.forEach(h => calGrid.appendChild(h));

            const year = currentDisplayDate.getFullYear();
            const month = currentDisplayDate.getMonth();
            
            const monthLabel = document.getElementById('monthLabel');
            if (monthLabel) monthLabel.textContent = `${MONTHS[month]} ${year}`;

            const firstDayIndex = new Date(year, month, 1).getDay();
            const totalDays = new Date(year, month + 1, 0).getDate();

            // Previous month empty slots
            for (let i = 0; i < firstDayIndex; i++) {
                const empty = document.createElement('div');
                empty.className = 'day-cell empty';
                calGrid.appendChild(empty);
            }

            // Generate Days
            for (let day = 1; day <= totalDays; day++) {
                const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                
                const dayReservations = (window.reservations && window.reservations[dateKey]) 
                    ? window.reservations[dateKey].filter(res => selectedFacility === 'all' || res.facilityKey === selectedFacility)
                    : [];

                const cell = document.createElement('div');
                cell.className = `day-cell ${dayReservations.length > 0 ? 'has-reservations' : ''}`;
                cell.innerHTML = `<div class="day-num">${day}</div>`;

                dayReservations.forEach(res => {
                    const pill = document.createElement('div');
                    pill.className = 'res-pill';
                    pill.textContent = res.facility;
                    cell.appendChild(pill);
                });

                if (dayReservations.length > 0) {
                    cell.onclick = () => {
                        const title = document.getElementById('modalTitle');
                        const body = document.getElementById('modalBody');
                        const resModal = document.getElementById('modalOverlay');
                        
                        if(title) title.textContent = "Reservations: " + dateKey;
                        if(body) {
                            body.innerHTML = dayReservations.map(res => `
                                <div style="border-bottom:1px solid #eee; padding:10px 0;">
                                    <strong style="color:#7c6fe0">${res.facility}</strong><br>
                                    <small>${res.time} | ${res.purpose}</small>
                                </div>
                            `).join('');
                        }
                        if(resModal) resModal.style.display = "flex";
                    };
                }
                calGrid.appendChild(cell);
            }
        }

        // Calendar Event Listeners
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const facilityFilter = document.getElementById('facilityFilter');
        const modalClose = document.getElementById('modalClose');

        if (prevBtn) prevBtn.onclick = () => { currentDisplayDate.setMonth(currentDisplayDate.getMonth() - 1); renderCalendar(); };
        if (nextBtn) nextBtn.onclick = () => { currentDisplayDate.setMonth(currentDisplayDate.getMonth() + 1); renderCalendar(); };
        if (facilityFilter) facilityFilter.onchange = (e) => { selectedFacility = e.target.value; renderCalendar(); };
        if (modalClose) modalClose.onclick = () => { document.getElementById('modalOverlay').style.display = 'none'; };

        renderCalendar();
    }
});