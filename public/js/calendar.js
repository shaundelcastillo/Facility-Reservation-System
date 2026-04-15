// public/js/calendar.js
const initCalendar = () => {
    const calendarGrid = document.getElementById('calendarGrid');
    const monthDisplay = document.getElementById('monthDisplay');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    // Safety check: If the elements aren't on this page, don't run the script
    if (!calendarGrid || !monthDisplay) return;

    let currentDate = new Date(2026, 0, 1); 

    function renderCalendar() {
        calendarGrid.innerHTML = ''; 
        
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        const monthName = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(currentDate);
        monthDisplay.innerText = `${monthName} ${year}`;

        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        days.forEach(day => {
            const dayLabel = document.createElement('div');
            dayLabel.className = 'day-label';
            dayLabel.innerText = day;
            calendarGrid.appendChild(dayLabel);
        });

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'date-card disabled';
            calendarGrid.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateCell = document.createElement('div');
            dateCell.className = 'date-card';
            
            const dateSpan = document.createElement('span');
            dateSpan.innerText = day;
            dateCell.appendChild(dateSpan);

            if (day === 18 && month === 0) {
                const resTag = document.createElement('div');
                resTag.className = 'res-tag';
                resTag.innerText = '10:00 AM - 12:00 PM';
                dateCell.appendChild(resTag);
            }
            calendarGrid.appendChild(dateCell);
        }
    }

    prevBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
};

// Run when the page is fully loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCalendar);
} else {
    initCalendar();
}