const overlay = document.getElementById('modalOverlay');
const viewModal = document.getElementById('viewModal');
const cancelModal = document.getElementById('cancelModal');
const reasonInput = document.getElementById('cancelReason');
const confirmCancelBtn = document.getElementById('confirmCancelBtn');

let currentActiveId = null;


function handleView(id) {
    const card = document.getElementById(`res-${id}`);
    if (!card) return;

    // Use data-attributes or specific classes to find data
    const facilityName = card.querySelector('h2').innerText;
    const dateText = card.querySelector('.details p i.fa-calendar').parentElement.innerText;
    const timeText = card.querySelector('.time').innerText;

    document.getElementById('modalFacility').innerText = facilityName;
    document.getElementById('modalDate').innerText = dateText;
    document.getElementById('modalTime').innerText = timeText;
    
    // Update Badge
    const statusBadge = card.querySelector('.badge');
    const modalBadge = document.getElementById('modalBadge');
    modalBadge.innerText = statusBadge.innerText;
    modalBadge.className = statusBadge.className; 

    document.getElementById('modalOverlay').style.display = 'block';
    document.getElementById('viewModal').style.display = 'block';
}

// Ensure the confirmation button works with the Fetch logic
confirmCancelBtn.addEventListener('click', () => {
    if (currentActiveId) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/reservation/${currentActiveId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json' 
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const card = document.getElementById(`res-${currentActiveId}`);
                closeModals();
                
               
                card.style.opacity = '0';
                card.style.transform = 'translateX(20px)';
                card.style.transition = 'all 0.4s ease';
                
                setTimeout(() => {
                    card.remove();
                    if (document.querySelectorAll('.reservations-list .card').length === 0) {
                        location.reload();
                    }
                }, 400);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error: Could not cancel reservation.");
        });
    }
});

// Open Cancel Modal and store the ID
function handleCancel(id) {
    currentActiveId = id;
    overlay.style.display = 'block';
    cancelModal.style.display = 'block';
    
    
    reasonInput.value = '';
    confirmCancelBtn.disabled = true;
}

function closeModals() {
    overlay.style.display = 'none';
    viewModal.style.display = 'none';
    cancelModal.style.display = 'none';
}


reasonInput.addEventListener('input', () => {
    confirmCancelBtn.disabled = reasonInput.value.trim().length < 10;
});


confirmCancelBtn.addEventListener('click', () => {
    if (currentActiveId) {
        // Get CSRF token from the meta tag in layout
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send DELETE request to Laravel Controller 
        // Using reservation_id logic from migration
        fetch(`/reservation/${currentActiveId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                reason: reasonInput.value 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const card = document.getElementById(`res-${currentActiveId}`);
                
                closeModals();

                // Animation for removal
                card.style.opacity = '0';
                card.style.transform = 'translateX(20px)';
                card.style.transition = 'all 0.4s ease';
                
                setTimeout(() => {
                    card.remove();
                    console.log(`Reservation ${currentActiveId} removed.`);
                    currentActiveId = null;
                }, 400);
            } else {
                alert("Something went wrong. Could not delete the reservation.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Server error. Please try again later.");
        });
    }
});

// Close when clicking outside the box
overlay.addEventListener('click', closeModals);