{{-- Index: Faculties --}}
@extends('layouts.app', [($page = 'faculties')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Fakultas')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.faculties.inc.title')

    {{-- Users table --}}
    @include('pages.faculties.inc.table')

@endsection

@push('scripts')
    <script src="{{ asset('js/faculties/index.min.js') }}"></script>
@endpush
