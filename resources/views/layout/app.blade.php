<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benedicto College - Facility Reservation</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes popIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-blur-bg {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); z-index: 10000; 
            justify-content: center; align-items: center;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    @include('partial._sidebar')
    <main class="main-content">
        @include('partial._header')
        <div class="content-area">
            @yield('content')
        </div>
        @include('partial._footer')
    </main>
</div>

<div id="universalCancelModal" class="modal-blur-bg">
    <div style="background: white; width: 90%; max-width: 500px; padding: 35px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); animation: popIn 0.3s ease-out;">
        <h2 style="margin-top: 0; color: #1a1a1a;">Cancel Reservation</h2>
        <p style="color: #666; font-size: 0.95rem; margin-top: 10px;">Please provide a reason for cancelling this reservation.</p>

        <div style="margin-top: 25px;">
            <label style="display: block; font-weight: bold; font-size: 0.9rem; margin-bottom: 8px;">Cancel Reservation *</label>
            <textarea id="uniCancelReason" rows="5" required minlength="10" placeholder="e.g., Schedule conflict..." style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 12px; background: #f9f9f9; resize: none; font-family: inherit;"></textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 35px;">
            <button type="button" onclick="closeUniModal('universalCancelModal')" style="padding: 12px 24px; background: white; border: 1px solid #ddd; border-radius: 10px; cursor: pointer;">Keep Reservation</button>
            <button type="button" onclick="submitUniCancel()" style="padding: 12px 24px; background: #ff4d4d; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">Cancel Reservation</button>
        </div>
    </div>
</div>

<div id="universalDetailsModal" class="modal-blur-bg" style="backdrop-filter: none; background: rgba(0,0,0,0.4);">
    <div style="background: white; width: 95%; max-width: 550px; padding: 40px; border-radius: 20px; position: relative; animation: popIn 0.3s ease-out;">
        <i class="fas fa-times" onclick="closeUniModal('universalDetailsModal')" style="position: absolute; top: 25px; right: 25px; cursor: pointer; font-size: 1.2rem; color: #999;"></i>
        
        <h2 style="margin-top: 0; color: #1a1a1a;">Reservation Details</h2>
        
        <div style="margin: 20px 0; display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #666; font-weight: 500;">Status</span>
            <span id="det-status" class="badge">Approved</span>
        </div>

        <div style="margin-top: 25px; display: flex; gap: 15px;">
            <i class="fas fa-building" style="color: #555; margin-top: 4px;"></i>
            <div>
                <strong style="display: block;">Facility Information</strong>
                <p id="det-facility" style="color: #777; margin: 5px 0;">--</p>
            </div>
        </div>

        <div style="margin-top: 20px; display: flex; gap: 15px;">
            <i class="fas fa-calendar-alt" style="color: #555; margin-top: 4px;"></i>
            <div>
                <strong style="display: block;">Schedule</strong>
                <p id="det-date" style="color: #777; margin: 5px 0;">--</p>
                <p id="det-time" style="color: #777; margin: 0;">--</p>
            </div>
        </div>

        <div style="margin-top: 20px; display: flex; gap: 15px;">
            <i class="fas fa-user" style="color: #555; margin-top: 4px;"></i>
            <div>
                <strong style="display: block;">Reservation Information</strong>
                <p id="det-user" style="color: #777; margin: 5px 0;">--</p>
            </div>
        </div>

        <div style="margin-top: 20px; display: flex; gap: 15px;">
            <i class="fas fa-tag" style="color: #555; margin-top: 4px;"></i>
            <div>
                <strong style="display: block;">Purpose</strong>
                <p id="det-purpose" style="color: #777; margin: 5px 0;">--</p>
            </div>
        </div>
    </div>
</div>

{{-- This hidden form is what actually talks to the database --}}
<form id="uniHiddenDeleteForm" method="POST" action="" style="display:none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="cancellation_reason" id="uniHiddenReasonInput">
</form>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>