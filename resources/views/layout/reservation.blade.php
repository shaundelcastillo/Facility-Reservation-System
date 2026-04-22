<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
@endpush

@section('content')
    @include('user.reservation')
@endsection

@push('scripts')
    <script src="{{ asset('js/reservation.js') }}"></script>
@endpush