@extends('layouts.app')
@section('title', 'Detail Data Pembelian')

@push('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/formplugins/summernote/summernote.css') }}">
@endpush
@push('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/datagrid/datatables/datatables.bundle.css') }}">
@endpush

@section('breadcrumb')
    <ol class="breadcrumb santri-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><strong>{{  getSettingData('web_name')->value ?? env('APP_NAME') }}</strong> WebApp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pembelian.index') }}">Transaksi</a></li>
        <li class="breadcrumb-item active">Detail Pembelian</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-newspaper'></i> Detail Pembelian
            <small>
                Detail Pembelian ini.
            </small>
        </h1>
        <div class="btn-group btn-group-sm text-center float-right" role="group">
            <a href="{{ url('/pembelian') }}" class="btn btn-primary btn-mini waves-effect waves-light"><span class="fal fa-backward"></span> Kembali</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Detail</strong> <span class="fw-300"><i>Pembelian</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label class="form-label">Tanggal Pembelian</label>
                                    <h5>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y | H:i') }}</h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Total Pembayaran</label>
                                    <h5> <strong>  Rp. {{ number_format($data->total_harga,0,',','.')}}  </strong> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Produk</strong> <span class="fw-300"><i>Dibeli</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <!-- datatable start -->
                            @php
                                $no = 1;
                            @endphp
                            <table class="table table-bordered table-hover table-striped w-100" id="dokumen-table">
                                <thead>
                                <tr>
                                    <td width="2%">No</td>
                                    <td>Nama Produk</td>
                                    <td>Harga Beli</td>
                                    <td>Jumlah beli</td>
                                    <td>Subtotal</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($detail_trans as $val)
                                    @php
                                        $subtotal = $val->jumlah_beli * $val->harga_beli;
                                        //$subtotal = $val->harga * $val->jumlah_beli;
                                    @endphp
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            <a href="{{route('produk.show',$val->id_produk)}}">
                                                {{$val->nama_produk}}
                                            </a>
                                        </td>
                                        <td>Rp. {{ number_format($val->harga_beli,0,',','.')}} </td>
                                        <td>{{$val->jumlah_beli}}</td>
                                        <td>Rp. {{ number_format($subtotal,0,',','.')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.partials._helper_js')
    {{--Fungsi script di tampilan transaksi pengguna--}}
    <script src="{{ asset('back-end/js/formplugins/select2/select2.bundle.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewFoto').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            $("#picture").change(function() {
                readURL(this);
            });
        })
    </script>
    <script>
        function saveData() {
            event.preventDefault();
            swal.fire({
                title: "Submit?",
                text: "Pastikan kembali data yang diisi.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-info",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "Simpan",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    $('#form-transaksi').submit()
                    showLoading(true);
                }
            })
        }
        $('.select2').select2({
            width: '100%',
            placeholder: "Pilih.."
        })
    </script>
@endpush
@push('scripts')
    @include('datatable._js')
    {{--Fungsi script di tampilan transaksi pengguna--}}
    <script src="{{ asset('back-end/js/datagrid/datatables/datatables.bundle.js') }}"></script>
@endpush