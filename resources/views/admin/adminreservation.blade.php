@extends('layout.admin')

@section('title', 'Manage Reservations')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminreservation.css') }}">
@endsection

@section('extra-js')
    <script src="{{ asset('adminjs/adminreservation.js') }}"></script>
@endsection

@section('content')
<div class="data-container">
    <h3>All Reservations</h3>
    <p class="subtitle">Manage and review all facility reservations</p>
    
    <div class="table-wrapper">
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Facility</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reservation-tbody">
                </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/reservation.js') }}"></script>
@endsection