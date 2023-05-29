{{-- Index: Grades --}}
@extends('layouts.app', [($page = 'users'), ($container = true)])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Nilai Rapor')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.grades.inc.title')

    {{-- Form card --}}
    @include('pages.grades.inc.form')

@endsection

@push('scripts')
    <script src="{{ asset('js/grades/index.min.js') }}"></script>
@endpush
