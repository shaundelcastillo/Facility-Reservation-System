@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
@endpush

@section('content')
    @include('user.reservation')
@endsection

@push('scripts')
    <script src="{{ asset('js/reservations.js') }}"></script>
@endpush