@extends('layouts.app')
@section('title', 'Data Supplier')

@push('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/datagrid/datatables/datatables.bundle.css') }}">
@endpush

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><strong>{{  getSettingData('web_name')->value ?? env('APP_NAME') }}</strong> WebApp</a></li>
        <li class="breadcrumb-item active">Supplier</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-list'></i> Supplier
            <small>
                Berisi Data Supplier
            </small>
        </h1>
        <div class="btn-group btn-group-sm text-center float-right">
            <a href="{{ url('/supplier/create') }}" class="btn btn-primary btn-mini waves-effect waves-light"><span class="fal fa-plus"></span> Tambah Supplier</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Supplier</strong> <span class="fw-300"><i>Table</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table class="table table-bordered table-hover table-striped w-100" id="kategori-table">
                            <thead>
                            <tr>
                                <td width="2%">No</td>
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Telepon</td>
                                <td width="20%">Action</td>
                            </tr>
                            </thead>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@include('datatable._js')
{{--Fungsi script di tampilan transaksi pengguna--}}
<script src="{{ asset('back-end/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script>
    var table;
    $(function(){
        'use strict';
        table = $('#kategori-table').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Cari...',
                sSearch: '',
                lengthMenu: '_MENU_ post/halaman',
            },
            processing: true,
            serverSide: true,
            'ajax': {
                'url': '{{ route('supplier.data') }}',
                'type': 'GET',
            },
            columns: [
                {
                    data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false
                },
                {
                    data: 'nama_supplier', name: 'nama_supplier', orderable: true,
                },
                {
                    data: 'alamat_supplier', name: 'alamat_supplier', orderable: true,
                },
                {
                    data: 'phone_supplier', name: 'phone_supplier', orderable: true,
                },
                {
                    data: '_action', name: '_action'
                }
            ],
            columnDefs: [
                {
                    className: 'text-center',
                    targets: [0, 1 , 4]
                }
            ],
        });
    });
</script>
@endpush
