{{-- Index: Study programs --}}
@extends('layouts.app', [($page = 'study-programs')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Program Studi')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.study-programs.inc.title')

    {{-- Study programs table --}}
    @include('pages.study-programs.inc.table')

@endsection

@push('scripts')
    <script src="{{ asset('js/study-programs/index.min.js') }}"></script>
@endpush
