{{-- Index: Applications --}}
@extends('layouts.app', [($page = 'applications')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Peserta')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.applications.inc.title')

    {{-- Applications table --}}
    @include('pages.applications.inc.table')

@endsection

@push('scripts')
    <script src="{{ asset('js/applications/index.min.js') }}"></script>
@endpush
