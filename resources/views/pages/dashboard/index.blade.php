{{-- Index: Dashboard --}}
@extends('layouts.app', [($page = 'dashboard')])

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Dasbor')

{{-- Content --}}
@section('content')

    {{-- Title --}}
    @include('pages.dashboard.inc.title')

    {{-- Dashboard post grids --}}
    <div class="row">

        {{-- Chart study program applications --}}
        <div class="col-sm-6">
            @include('pages.dashboard.inc.chart-study-program-applications')
        </div>

        {{-- Chart accepted study program --}}
        <div class="col-sm-6">
            @include('pages.dashboard.inc.chart-accepted-study-program')
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard/index.min.js') }}"></script>
@endpush
