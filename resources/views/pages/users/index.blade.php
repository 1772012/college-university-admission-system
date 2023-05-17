{{-- Index: Users --}}
@extends('layouts.app', [($page = 'users')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Akun Pendaftar')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.users.inc.title')

    {{-- Users table --}}
    @include('pages.users.inc.table')

@endsection

@push('scripts')
    <script src="{{ asset('js/users/index.min.js') }}"></script>
@endpush
