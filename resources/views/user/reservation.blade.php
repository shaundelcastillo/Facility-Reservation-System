<div class="main-container">
    <div class="blue-header-box">
        <h1>My Reservations</h1>
        <p>View and manage all your facility reservations</p>
    </div>

    <div class="reservations-list">
        @forelse($reservations as $res)
            {{-- Updated to reservation_id --}}
            <div class="card" id="res-{{ $res->reservation_id }}">
                <div class="card-content">
                    <div class="card-header">
                        <h2>{{ $res->room->room_number ?? 'Unknown Facility' }}</h2>
                        <span class="badge {{ $res->status }}">{{ ucfirst($res->status) }}</span>
                    </div>
                    <div class="details">
                        <p><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($res->start_time)->format('F j, Y') }}</p>
                        <p><i class="fa-regular fa-file-lines"></i> <strong>Purpose:</strong> {{ $res->purpose ?? 'No purpose provided' }}</p>
                        <p><i class="fa-solid fa-location-dot"></i> <strong>Reserved by:</strong> {{ Auth::user()->name }}</p>
                    </div>
                </div>
                <div class="card-right">
                    <div class="time">
                        <i class="fa-regular fa-clock"></i> 
                        {{ \Carbon\Carbon::parse($res->start_time)->format('g:i A') }} - 
                        {{ \Carbon\Carbon::parse($res->end_time)->format('g:i A') }}
                    </div>
                    <div class="actions">
                        {{-- Updated both function calls to use reservation_id --}}
                        <button class="btn-view" onclick="handleView({{ $res->reservation_id }})">
                            <i class="fa-regular fa-eye"></i> View Details
                        </button>
                        <button class="btn-cancel" onclick="handleCancel({{ $res->reservation_id }})">
                            <i class="fa-regular fa-trash-can"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-content" style="text-align: center; padding: 40px;">
                    <p style="color: #666;">You have no reservations yet.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<div id="modalOverlay" class="modal-overlay"></div>

<div id="viewModal" class="modal">
    <div class="modal-header">
        <h3 style="margin:0">Reservation Details</h3>
        <button class="close-btn" onclick="closeModals()">&times;</button>
    </div>
    <div class="modal-body">
        <div class="status-row">
            <span>Status</span>
            <span class="badge" id="modalBadge"></span>
        </div>
        
        <div class="info-section">
            <p class="section-title"><i class="fa-solid fa-building"></i> Facility Information</p>
            <div class="info-grid">
                <span class="label">Facility Name</span>
                {{-- FIXED: Changed id to modalFacility --}}
                <span class="value" id="modalFacility"></span>
            </div>
        </div>

        <div class="info-section">
            <p class="section-title"><i class="fa-regular fa-calendar-check"></i> Schedule</p>
            <div class="info-grid">
                <span class="label">Date</span>
                <span class="value" id="modalDate"></span>
                <span class="label">Time</span>
                <span class="value" id="modalTime"></span>
            </div>
        </div>

        <div class="info-section">
            <p class="section-title"><i class="fa-regular fa-user"></i> Reservation Information</p>
            <div class="info-grid">
                <span class="label">Reserved By</span>
                {{-- This remains modalUser as it refers to the person --}}
                <span class="value" id="modalUser">{{ Auth::user()->name ?? 'Guest User' }}</span>
            </div>
        </div>
    </div>
</div>