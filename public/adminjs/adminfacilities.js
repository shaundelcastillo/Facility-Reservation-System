// 1. Data Array
const facilities = [
    { name: "Room 301", cap: "40 seats", desc: "Standard classroom with modern facilities", tags: ["Projector", "Whiteboard", "Air Condition"] },
    { name: "Room 309", cap: "35 seats", desc: "Spacious classroom for lectures and discussions", tags: ["Projector", "Whiteboard", "Air Condition"] },
    { name: "Computer Lab 1", cap: "30 seats", desc: "Fully equipped computer laboratory with latest hardware", tags: ["Desktop Computers", "Projector", "Air Condition", "Whiteboard"] },
    { name: "Computer Lab 2", cap: "30 seats", desc: "Programming and development lab with specialized software", tags: ["Desktop Computers", "Projector", "Air Condition", "Whiteboard"] },
    { name: "Artist Hall", cap: "200 seats", desc: "Large multipurpose hall suitable for conferences, presentations, and ceremonies.", tags: ["Projector", "Stage", "Sound System"] },
    { name: "Kenetics", cap: "200 seats", desc: "Large indoor gymnasium used for basketball, sports activities, and school events.", tags: ["Stage", "Basketball Court", "Sound System"] },
    { name: "Library", cap: "40 seats", desc: "Quiet study space providing access to books, study tables, and computers.", tags: ["Tables", "Chairs", "Desktop Computers"] },
    { name: "Amphitheater", cap: "200 seats", desc: "Indoor lecture hall used for seminars, presentations, and academic gatherings.", tags: ["Projector", "Sound System", "Microphones"] },
    { name: "Study Room 1", cap: "40 seats", desc: "Quiet study room for group discussions", tags: ["Whiteboard", "Study Tables", "Air Condition"] }
];

// 2. Selectors
const grid = document.getElementById('facilities-grid');
const modal = document.getElementById('facilityModal');
const addBtn = document.querySelector('.btn-add-facility');
const closeBtn = document.getElementById('closeModal');
const form = document.getElementById('addFacilityForm');

const logoutBtn = document.getElementById('logoutBtn');
const confirmModal = document.getElementById('confirmModal');
const modalConfirmBtn = document.getElementById('modalConfirmBtn');
const cancelLogoutBtn = document.getElementById('cancelLogout');

// 3. Render Function
function renderFacilities() {
    if(!grid) return;
    grid.innerHTML = facilities.map(f => `
        <div class="facility-card">
            <div class="capacity-badge">${f.cap}</div>
            <h3>${f.name}</h3>
            <p>${f.desc}</p>
            <div class="tag-container">
                ${f.tags.map(tag => `<span class="facility-tag">${tag.trim()}</span>`).join('')}
            </div>
        </div>
    `).join('');
}

// 4. Facility Modal Controls
if (addBtn) addBtn.onclick = () => modal.style.display = "block";
if (closeBtn) closeBtn.onclick = () => modal.style.display = "none";

if (form) {
    form.onsubmit = (e) => {
        e.preventDefault();
        const newFacility = {
            name: document.getElementById('facName').value,
            cap: document.getElementById('facCap').value + " seats",
            desc: document.getElementById('facDesc').value,
            tags: document.getElementById('facTags').value.split(',')
        };
        facilities.push(newFacility);
        renderFacilities();
        form.reset();
        modal.style.display = "none";
    };
}

// 5. Logout Logic
if (logoutBtn) {
    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        confirmModal.style.display = 'flex';
    });
}

if (modalConfirmBtn) {
    modalConfirmBtn.addEventListener('click', () => {
        document.getElementById('logout-form').submit();
    });
}

if (cancelLogoutBtn) {
    cancelLogoutBtn.addEventListener('click', () => {
        confirmModal.style.display = 'none';
    });
}

// 6. Global Click Listener
window.addEventListener('click', (event) => {
    if (event.target === modal) modal.style.display = "none";
    if (event.target === confirmModal) confirmModal.style.display = "none";
});

// 7. Initial Load
document.addEventListener('DOMContentLoaded', renderFacilities);