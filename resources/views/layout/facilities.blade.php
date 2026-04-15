@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/facilities.css') }}">
@endpush

@section('content')
    @include('user.facilities')
@endsection

@push('scripts')
    <script src="{{ asset('js/facilities.js') }}"></script>
@endpush