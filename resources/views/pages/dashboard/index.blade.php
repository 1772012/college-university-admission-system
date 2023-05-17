{{-- Index: Dashboard --}}
@extends('layouts.app', [($page = 'dashboard')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Dasbor')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.dashboard.inc.title')

@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/admin/dashboard/index.min.js') }}"></script> --}}
@endpush
