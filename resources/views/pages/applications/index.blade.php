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
    <script>
        $(document).ready(function () {
            $('#applications-datatables').DataTable({
                ajax: $('#applications-datatables').attr('data-source'),
                processing: true,
                serverSide: true,
                columns: [
                    {
                        data: 'created-at',
                        name: 'applications.created_at',
                        className: 'align-middle text-center',
                        width: '15%',
                        title: 'Tgl. Daftar',
                    },
                    {
                        data: 'nrp',
                        name: 'nrp',
                        className: 'align-middle text-center',
                        title: 'NRP',
                    },
                    {
                        data: 'name',
                        name: 'user.userDetail.name',
                        className: 'align-middle',
                        title: 'Nama Lengkap',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'application-study-program',
                        name: 'application-study-program',
                        className: 'align-middle',
                        width: '30%',
                        title: 'Program Studi',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'align-middle text-center',
                        width: '10%',
                        title: 'Status',
                        searchable: false,
                        orderable: false,
                    },
                    // {
                    //     'data': 'action',
                    //     'name': 'action',
                    //     'className': 'align-middle text-right',
                    //     'title': '',
                    //     'searchable': false,
                    //     'orderable': false,
                    // },
                ],
            });
        });
    </script>
@endpush
