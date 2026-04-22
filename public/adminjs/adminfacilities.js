document.addEventListener('DOMContentLoaded', function() {
    const addModal = document.getElementById("facilityModal");
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("deleteConfirmModal");
    
    const openAddBtn = document.getElementById("openModal");
    const closeAddBtn = document.getElementById("closeModal");
    const closeEditBtn = document.getElementById("closeEditModalBtn");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

    // Close Modals
    if (closeAddBtn) closeAddBtn.onclick = () => addModal.style.display = "none";
    if (closeEditBtn) closeEditBtn.onclick = () => editModal.style.display = "none";
    if (cancelDeleteBtn) cancelDeleteBtn.onclick = () => deleteModal.style.display = "none";

    // Open Add
    if (openAddBtn) openAddBtn.onclick = () => addModal.style.display = "block";

    // Close if clicked outside
    window.onclick = (event) => {
        if (event.target === addModal) addModal.style.display = "none";
        if (event.target === editModal) editModal.style.display = "none";
        if (event.target === deleteModal) deleteModal.style.display = "none";
    };
});

// GLOBAL: EDIT MODAL
function openEditModal(facility) {
    const form = document.getElementById('editFacilityForm');
    document.getElementById('editName').value = facility.room_number || '';
    document.getElementById('editCap').value = facility.capacity || '';
    document.getElementById('editDesc').value = facility.description || '';
    document.getElementById('editTags').value = facility.amenities || '';
    
    form.action = "/admin/facilities/" + facility.room_id;
    document.getElementById('editModal').style.display = "block";
}

// GLOBAL: DELETE MODAL LOGIC
let currentDeleteId = null;
function confirmDelete(id) {
    currentDeleteId = id;
    document.getElementById("deleteConfirmModal").style.display = "block";
}

document.getElementById("confirmDeleteBtn").onclick = function() {
    if (currentDeleteId) {
        document.getElementById('delete-form-' + currentDeleteId).submit();
    }
};