@extends('layout.admin')

@section('title', 'Facilities')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminfacilities.css') }}">
@endsection

@section('content')
<div class="data-container">
    <div id="facilityModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Facility</h3>
                <span class="close-btn" id="closeModal">&times;</span>
            </div>
            <form id="addFacilityForm">
                @csrf
                <div class="form-group">
                    <label>Facility Name</label>
                    <input type="text" id="facName" required>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="text" id="facCap" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="facDesc" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Amenities (Comma separated)</label>
                    <input type="text" id="facTags">
                </div>
                <button type="submit" class="btn-submit">Add Facility</button>
            </form>
        </div>
    </div>

    <div class="title-row">
        <h3>Facilities Overview</h3>
        <button class="btn-add-facility"><i class='bx bx-plus-circle'></i> Add Facility</button>
    </div>
    <p class="subtitle">View all available facilities in the system</p>
    
    <div class="facilities-grid" id="facilities-grid">
        @foreach($facilities as $facility)
            <div class="facility-card">
                <span class="capacity-badge">{{ $facility->capacity }} seats</span>
                <h3>{{ $facility->name }}</h3>
                <p>{{ $facility->description }}</p>
                
                <div class="tag-container">
                    {{-- This splits the comma-separated string into individual tags --}}
                    @foreach(explode(',', $facility->amenities) as $tag)
                        <span class="facility-tag">{{ trim($tag) }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('adminjs/shared-admin.js') }}"></script>
    {{-- Removed duplicate section and kept the one with the correct path --}}
@endsection