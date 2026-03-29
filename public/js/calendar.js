const reservations = {
    '2026-01-18': [
        { facility: 'Computer Lab 1', facilityKey: 'lab1',         time: '9:00 AM – 11:00 AM',  purpose: 'Web Development Workshop',     reservedBy: 'Juan Dela Cruz (IT)',   status: 'approved' },
        { facility: 'Study Room 1',   facilityKey: 'study1',       time: '1:00 PM – 3:00 PM',   purpose: 'Group Study Session',          reservedBy: 'Carlos Mendiola (CS)',  status: 'approved' },
    ],
    '2026-01-20': [
        { facility: 'Artist Hall',    facilityKey: 'artist',       time: '2:00 PM – 5:00 PM',   purpose: 'IT Symposium 2026',            reservedBy: 'Maria Santos (IT)',     status: 'pending'  },
    ],
    '2026-01-22': [
        { facility: 'Amphitheater',   facilityKey: 'amphitheater', time: '10:00 AM – 12:00 PM', purpose: 'Thesis Defense',               reservedBy: 'Pablo Garcia (IT)',     status: 'approved' },
        { facility: 'Computer Lab 2', facilityKey: 'lab2',         time: '3:00 PM – 5:00 PM',   purpose: 'Student Org Meeting',          reservedBy: 'Anna Reyes (IT)',       status: 'approved' },
    ],
    '2026-01-23': [
        { facility: 'Computer Lab 2', facilityKey: 'lab2',         time: '1:00 PM – 3:00 PM',   purpose: 'Software Engineering Lab',     reservedBy: 'Leo Reyes (IT)',        status: 'approved' },
    ],
    '2026-01-25': [
        { facility: 'Library',        facilityKey: 'library',      time: '8:00 AM – 10:00 AM',  purpose: 'Research Study',               reservedBy: 'Nina Cruz (CS)',        status: 'approved' },
    ],
    '2026-01-28': [
        { facility: 'Room 301',       facilityKey: 'room301',      time: '9:00 AM – 11:00 AM',  purpose: 'Faculty Meeting',              reservedBy: 'Prof. Santos',          status: 'approved' },
    ],
    '2026-02-03': [
        { facility: 'Genetics',       facilityKey: 'genetics',     time: '1:00 PM – 3:00 PM',   purpose: 'Biology Lab Session',          reservedBy: 'Kim Alvarez (Bio)',     status: 'approved' },
    ],
    '2026-02-10': [
        { facility: 'Study Room 2',   facilityKey: 'study2',       time: '3:00 PM – 5:00 PM',   purpose: 'Thesis Consultation',          reservedBy: 'Marco Diaz (IT)',       status: 'pending'  },
        { facility: 'Computer Lab 1', facilityKey: 'lab1',         time: '8:00 AM – 10:00 AM',  purpose: 'Web Systems Class',            reservedBy: 'Prof. Reyes',           status: 'approved' },
    ],
};

const MONTHS = [
    'January','February','March','April','May','June',
    'July','August','September','October','November','December'
];

let current      = new Date(2026, 0, 1);
let activeFilter = 'all';

function pad(n) {
    return String(n).padStart(2, '0');
}

function dateKey(y, m, d) {
    return `${y}-${pad(m + 1)}-${pad(d)}`;
}


function getFiltered(key) {
    const entries = reservations[key] || [];
    return activeFilter === 'all'
        ? entries
        : entries.filter(r => r.facilityKey === activeFilter);
}


function buildCalendar() {
    const grid    = document.getElementById('calGrid');
    const headers = [...grid.querySelectorAll('.day-header')];

    grid.innerHTML = '';
    headers.forEach(h => grid.appendChild(h));

    document.getElementById('monthLabel').textContent =
        `${MONTHS[current.getMonth()]} ${current.getFullYear()}`;

    const y           = current.getFullYear();
    const m           = current.getMonth();
    const firstDay    = new Date(y, m, 1).getDay();
    const daysInMonth = new Date(y, m + 1, 0).getDate();
    const today       = new Date();

   
    for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement('div');
        empty.className = 'day-cell empty';
        grid.appendChild(empty);
    }

    // Day cells
    for (let d = 1; d <= daysInMonth; d++) {
        const key     = dateKey(y, m, d);
        const entries = getFiltered(key);
        const hasRes  = entries.length > 0;
        const isToday = today.getFullYear() === y &&
                        today.getMonth()    === m &&
                        today.getDate()     === d;

        const cell = document.createElement('div');
        cell.className = ['day-cell',
            hasRes  ? 'has-reservations' : '',
            isToday ? 'today'            : '',
        ].filter(Boolean).join(' ');

        // Day number
        const num = document.createElement('div');
        num.className   = 'day-num';
        num.textContent = d;
        cell.appendChild(num);

        // Reservation pills
        if (hasRes) {
            entries.forEach(r => {
                const pill = document.createElement('div');
                pill.className   = 'res-pill';
                pill.textContent = r.time;
                cell.appendChild(pill);
            });
            cell.addEventListener('click', () => openModal(key, y, m, d));
        }

        grid.appendChild(cell);
    }
}

// ── MODAL ──
function openModal(key, y, m, d) {
    const entries = getFiltered(key);
    const title   = document.getElementById('modalTitle');
    const body    = document.getElementById('modalBody');

    title.textContent = `${MONTHS[m]} ${d}, ${y}`;
    body.innerHTML    = '';

    if (entries.length === 0) {
        body.innerHTML = '<p class="modal-empty">No reservations for this day.</p>';
    } else {
        entries.forEach(r => {
            const statusLabel = r.status.charAt(0).toUpperCase() + r.status.slice(1);
            const item = document.createElement('div');
            item.className = 'modal-res-item';
            item.innerHTML = `
                <div class="modal-res-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="modal-res-info">
                    <div class="modal-res-facility">${r.facility}</div>
                    <div class="modal-res-time"><i class="far fa-clock"></i> ${r.time}</div>
                    <div class="modal-res-detail"><i class="fas fa-clipboard-list"></i> ${r.purpose}</div>
                    <div class="modal-res-detail"><i class="fas fa-user"></i> ${r.reservedBy}</div>
                </div>
                <span class="modal-badge ${r.status}">${statusLabel}</span>
            `;
            body.appendChild(item);
        });
    }

    document.getElementById('modalOverlay').classList.add('open');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

// ── EVENT LISTENERS ───
document.getElementById('prevBtn').addEventListener('click', () => {
    current.setMonth(current.getMonth() - 1);
    buildCalendar();
});

document.getElementById('nextBtn').addEventListener('click', () => {
    current.setMonth(current.getMonth() + 1);
    buildCalendar();
});

document.getElementById('facilityFilter').addEventListener('change', e => {
    activeFilter = e.target.value;
    buildCalendar();
});

document.getElementById('modalClose').addEventListener('click', closeModal);

document.getElementById('modalOverlay').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeModal();
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});


buildCalendar();
