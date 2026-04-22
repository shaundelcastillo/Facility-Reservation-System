document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('bookingOverlay');
    const closeBtn = document.getElementById('closeModal');
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.facility-card');

    // 1. Search Logic
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                card.style.display = name.includes(query) ? 'flex' : 'none';
            });
        });
    }

    // 2. Filter Logic (Classrooms, Labs, etc.)
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const type = this.getAttribute('data-type');
            cards.forEach(card => {
                if (type === 'all' || card.classList.contains(type)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 3. Modal Trigger
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('book-btn') && !e.target.disabled) {
            const card = e.target.closest('.facility-card');
            const roomName = card.querySelector('h3').innerText;
            const roomId = card.getAttribute('data-id');
            
            document.getElementById('displayRoomName').innerText = roomName;
            document.getElementById('inputRoomId').value = roomId;
            
            if (overlay) overlay.style.display = 'flex';
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', () => overlay.style.display = 'none');
    }
});