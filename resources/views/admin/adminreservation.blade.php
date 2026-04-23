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
                    <th style="text-align: center;">Manage</th>
                    <th style="text-align: center;">Delete</th>
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
                        <span class="badge {{ strtolower($res->status) }}">{{ ucfirst($res->status) }}</span>
                    </td>

                    {{-- UPDATED COLUMN 1: Manage Status (Approve/Reject) --}}
                    <td style="text-align: center;">
                        <div class="action-group" style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                            {{-- We use strtolower to make sure 'Pending' or 'PENDING' both work --}}
                            @if(strtolower($res->status) == 'pending')
                                <form action="{{ route('admin.updateStatus', $res->reservation_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn-check" title="Approve" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-check-square" style="color: #2ecc71; font-size: 18px;"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.updateStatus', $res->reservation_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn-cross" title="Reject" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-times-circle" style="color: #e74c3c; font-size: 18px;"></i>
                                    </button>
                                </form>
                            @else
                                <span style="color: #95a5a6; font-size: 0.8rem;">No Actions</span>
                            @endif
                        </div>
                    </td>

                    {{-- COLUMN 2: Database Management (Permanent Delete) --}}
                    <td style="text-align: center;">
                        <form action="{{ route('admin.reservations.destroy', $res->reservation_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation? This cannot be undone.')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-res" title="Delete Permanently" style="background: none; border: none; cursor: pointer;">
                                <i class="fas fa-trash-alt" style="color: #e74c3c; font-size: 18px;"></i>
                            </button>
                        </form>
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