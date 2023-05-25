{{-- Index: Create applications --}}
@extends('layouts.app', [($page = 'users'), ($container = true)])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Buat Peserta Baru')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.applications.create.inc.title')

    {{-- Form card --}}
    @include('pages.applications.create.inc.form')

@endsection

@push('scripts')
    <script src="{{ asset('js/applications/create.min.js') }}"></script>
@endpush
