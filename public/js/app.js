//JS of facilties only
// Wait for the page to fully load before running the script
document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. MODAL ELEMENTS ---
    var modal = document.getElementById('bookingModal');
    var modalTitle = document.getElementById('modalTitle');
    var closeModalBtn = document.getElementById('closeModal');
    var bookButtons = document.querySelectorAll('.book-btn');

    // --- 2. SEARCH & FILTER  ---
    var searchInput = document.getElementById('searchInput');
    var filterButtons = document.querySelectorAll('.filter-btn');
    var facilityCards = document.querySelectorAll('.facility-card');

    // --- 3. MODAL LOGIC (Opening and Closing) ---
    bookButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Find the closest card to get the facility name
            var card = btn.closest('.facility-card');
            var facilityName = card.getAttribute('data-name');
            
            // Set the modal title and show the modal
            modalTitle.innerText = "Book " + facilityName;
            modal.style.display = "flex";
        });
    });

    // Close modal when "Cancel" is clicked
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    // --- 4. SEARCH LOGIC ---
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            var filterValue = searchInput.value.toLowerCase();

            facilityCards.forEach(function(card) {
                var text = card.innerText.toLowerCase();
                // Show card if text matches search, otherwise hide it
                if (text.indexOf(filterValue) > -1) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

    // --- 5. FILTER LOGIC (Category Buttons) ---
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Remove 'active' class from all buttons and add to the clicked one
            filterButtons.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var selectedType = btn.getAttribute('data-type');

            facilityCards.forEach(function(card) {
                // If "all" is picked or the card has the right class, show it
                if (selectedType === 'all' || card.classList.contains(selectedType)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });

});