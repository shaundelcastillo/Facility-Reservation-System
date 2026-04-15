// Ensure script runs after everything is loaded
window.addEventListener('load', function() {
    const overlay = document.getElementById('bookingOverlay');
    const closeBtn = document.getElementById('closeModal');
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.facility-card');

    // 1. SEARCH BAR LOGIC
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            cards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                card.style.display = name.includes(term) ? "block" : "none";
            });
        });
    }

    // 2. FILTER BUTTONS LOGIC
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const type = this.getAttribute('data-type');
            cards.forEach(card => {
                if (type === 'all' || card.classList.contains(type)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });

    // 3. BOOKING BUTTON LOGIC
    document.addEventListener('click', function(e) {
        // Check if the clicked element is a "Book This Facility" button
        if (e.target && e.target.classList.contains('book-btn')) {
            const card = e.target.closest('.facility-card');
            const roomName = card.querySelector('h3').innerText;
            
            // Set values in the form
            document.getElementById('displayRoomName').innerText = roomName;
            document.getElementById('inputRoomName').value = roomName;
            
            // Show the blur overlay
            overlay.style.display = 'flex';
        }
    });

    // 4. CLOSE MODAL
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            overlay.style.display = 'none';
        });
    }
});