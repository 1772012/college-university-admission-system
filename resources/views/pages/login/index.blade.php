{{-- Index: Login --}}
@extends('layouts.login')

{{-- Web title --}}
@section('web-title', 'DPBA Universitas Kristen Maranatha - Dasbor')

{{-- Content --}}
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg card-rounded my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block text-center py-5">
                            <img src="{{ asset('assets/images/logo-maranatha-blue.png') }}" alt="" style="width: 50%">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">

                                {{-- Title --}}
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Manajemen PMB Universitas Kristen Maranatha</h1>
                                </div>

                                @if (session('error-message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>Login gagal.</strong> {{ session('error-message') }}
                                    </div>
                                @endif

                                {{-- Form --}}
                                <form class="user" action="{{ route('login.auth') }}" method="POST">
                                    @csrf

                                    {{-- Email --}}
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            name="email" placeholder="Email">
                                    </div>

                                    {{-- Password --}}
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password"
                                            name="password" placeholder="Password">
                                    </div>

                                    {{-- Login button --}}
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/admin/dashboard/index.min.js') }}"></script> --}}
@endpush
