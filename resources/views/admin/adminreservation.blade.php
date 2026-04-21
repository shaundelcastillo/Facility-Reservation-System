@extends('layout.admin')

@section('title', 'Manage Reservations')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('admincss/adminreservation.css') }}">
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
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $res)
                <tr>
                    <td>{{ $res->user->name ?? 'Unknown' }}</td>
                    <td>{{ $res->room->room_number ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->start_time)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($res->end_time)->format('h:i A') }}</td>
                    <td>{{ $res->purpose }}</td>
                    <td>
                        <span class="badge {{ $res->status }}">{{ ucfirst($res->status) }}</span>
                    </td>
                    <td style="text-align: center;">
                        @if($res->status == 'pending')
                            <div class="action-group" style="display: flex; gap: 10px; justify-content: center;">
                                <form action="{{ route('admin.updateStatus', $res->reservation_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn-check" title="Approve Reservation">
                                        <i class="fas fa-check-square"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.updateStatus', $res->reservation_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn-cross" title="Reject Reservation">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            <span style="color: #bbb; font-size: 12px;">No Actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{ asset('adminjs/adminreservation.js') }}"></script>
@endsection