@extends('layout.admin')

@section('title', 'Facilities')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminfacilities.css') }}">
@endsection

@section('content')
<div class="data-container">
    {{-- ADD FACILITY MODAL --}}
    <div id="facilityModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Facility</h3>
                <span class="close-btn" id="closeModal">&times;</span>
            </div>
            <form id="addFacilityForm" action="{{ route('admin.facilities.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Facility Name</label>
                    <input type="text" name="room_number" required>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" name="capacity" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Amenities (Comma separated)</label>
                    <input type="text" name="amenities">
                </div>
                <button type="submit" class="btn-submit">Add Facility</button>
            </form>
        </div>
    </div>

   {{-- MODERN EDIT FACILITY MODAL --}}
    <div id="editModal" class="modal">
        <div class="modal-content edit-facility-modal">
            <div class="modal-header">
                <h3><i class='bx bx-edit-alt'></i> Edit Facility Details</h3>
                <span class="close-btn" id="closeEditModalBtn">&times;</span>
            </div>
            
            <form id="editFacilityForm" method="POST" class="modern-form">
                @csrf
                @method('PUT')
                
                <div class="form-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class='bx bx-building'></i> Facility Name</label>
                            <input type="text" name="room_number" id="editName" placeholder="e.g. Room 301" required>
                        </div>
                        <div class="form-group">
                            <label><i class='bx bx-group'></i> Capacity</label>
                            <input type="number" name="capacity" id="editCap" placeholder="0" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class='bx bx-list-plus'></i> Amenities (Comma separated)</label>
                        <input type="text" name="amenities" id="editTags" placeholder="Projector, Air Condition, Whiteboard...">
                    </div>

                    <div class="form-group">
                        <label><i class='bx bx-detail'></i> Description</label>
                        <textarea name="description" id="editDesc" rows="4" placeholder="Briefly describe the facility..." required></textarea>
                    </div>
                </div>

                <div class="modal-footer-action">
                    <button type="submit" class="btn-update-facility">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div id="deleteConfirmModal" class="modal">
        <div class="modal-content delete-modal">
            <div class="modal-body">
                <div class="warning-icon"><i class='bx bx-error-circle'></i></div>
                <h3>Are you sure?</h3>
                <p>This action will permanently delete this facility and cannot be undone.</p>
                <div class="modal-footer">
                    <button class="btn-cancel" id="cancelDeleteBtn">Cancel</button>
                    <button class="btn-confirm-delete" id="confirmDeleteBtn">Delete Anyway</button>
                </div>
            </div>
        </div>
    </div>

    <div class="title-row">
        <h3>Facilities Overview</h3>
        <button class="btn-add-facility" id="openModal"><i class='bx bx-plus-circle'></i> Add Facility</button>
    </div>
    
   <div class="facilities-grid">
    @foreach($facilities as $facility)
        <div class="facility-card">
            <span class="capacity-badge">{{ $facility->capacity }} seats</span>
            <h3>{{ $facility->room_number }}</h3>
            <p>{{ $facility->description ?? 'Standard facility available.' }}</p>
            
            <div class="tag-container">
                @if($facility->amenities)
                    @foreach(explode(',', $facility->amenities) as $tag)
                        <span class="facility-tag">{{ trim($tag) }}</span>
                    @endforeach
                @else
                    <span class="facility-tag">General</span>
                @endif
            </div>

            {{-- Tightened Card Footer --}}
            <div class="card-footer-layout">
                <div class="manage-section">
                    <button class="btn-action edit" onclick="openEditModal({{ json_encode($facility) }})" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.4); padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 13px;">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                </div>
                
                <div class="remove-section">
                    <button type="button" class="btn-action delete" onclick="confirmDelete({{ $facility->room_id }})" style="background: none; border: none; color: #ff5e5e; cursor: pointer; font-size: 1.1rem;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <form id="delete-form-{{ $facility->room_id }}" action="{{ url('/admin/facilities/' . $facility->room_id) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('adminjs/adminfacilities.js') }}"></script>
@endsection