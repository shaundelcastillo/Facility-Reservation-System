const reservations = {
    '2026-01-18': ['9:00 AM - 11:00 AM', '1:00 PM - 3:00 PM'],
    '2026-01-20': ['2:00 PM - 5:00 PM'],
    '2026-01-22': ['10:00 AM - 12:00 PM', '3:00 PM - 5:00 PM'],
    '2026-01-23': ['1:00 PM - 3:00 PM'],
    '2026-01-25': ['8:00 AM - 10:00 AM'],
};

const months = [
    'January', 'February', 'March', 'April',
    'May', 'June', 'July', 'August',
    'September', 'October', 'November', 'December'
];

let current = new Date(2026, 0, 1);

function pad(n) {
    return String(n).padStart(2, '0');
}

function dateKey(y, m, d) {
    return `${y}-${pad(m + 1)}-${pad(d)}`;
}

function buildCalendar() {
    const grid = document.getElementById('calGrid');
    const headers = [...grid.querySelectorAll('.day-header')];

    grid.innerHTML = '';
    headers.forEach(h => grid.appendChild(h));

    document.getElementById('monthLabel').textContent =
        `${months[current.getMonth()]} ${current.getFullYear()}`;

    const y          = current.getFullYear();
    const m          = current.getMonth();
    const firstDay   = new Date(y, m, 1).getDay();
    const daysInMonth = new Date(y, m + 1, 0).getDate();
    const today      = new Date();

    // Empty cells before the 1st
    for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement('div');
        empty.className = 'day-cell empty';
        grid.appendChild(empty);
    }

    // Day cells
    for (let d = 1; d <= daysInMonth; d++) {
        const key     = dateKey(y, m, d);
        const hasRes  = !!reservations[key];
        const isToday = today.getFullYear() === y &&
                        today.getMonth()    === m &&
                        today.getDate()     === d;

        const cell = document.createElement('div');
        cell.className = 'day-cell' + (isToday ? ' today' : '');

        const num = document.createElement('div');
        num.className   = 'day-num';
        num.textContent = d;
        cell.appendChild(num);

        if (hasRes) {
            reservations[key].forEach(time => {
                const pill = document.createElement('div');
                pill.className   = 'res-pill';
                pill.textContent = time;
                cell.appendChild(pill);
            });
        }

        grid.appendChild(cell);
    }
}

document.getElementById('prevBtn').addEventListener('click', () => {
    current.setMonth(current.getMonth() - 1);
    buildCalendar();
});

document.getElementById('nextBtn').addEventListener('click', () => {
    current.setMonth(current.getMonth() + 1);
    buildCalendar();
});

buildCalendar();
