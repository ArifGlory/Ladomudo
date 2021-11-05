@extends('layouts.app')
@section('title', 'Detail Data Transaksi')

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
        <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
        <li class="breadcrumb-item active">Detail Transaksi</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-newspaper'></i> Detail Transaksi
            <small>
                Detail Transaksi ini.
            </small>
        </h1>
        <div class="btn-group btn-group-sm text-center float-right" role="group">
            <a href="{{ url('/transaksi') }}" class="btn btn-primary btn-mini waves-effect waves-light"><span class="fal fa-backward"></span> Kembali</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Detail</strong> <span class="fw-300"><i>Transaksi</i></span>
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
                                    <label class="form-label">Nama Pelanggan</label>
                                    <h5>{{$data->name}}</h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Alamat</label>
                                    <h5>{{$data->alamat}}</h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Telepon</label>
                                    <h5>{{$data->phone}}</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <label class="form-label">Tanggal Transaksi</label>
                                    <h5>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Total Pembayaran</label>
                                    <h5> <strong>  Rp. {{ number_format($data->total_harga,0,',','.')}}  </strong> </h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Status Transaksi</label>
                                    <h5> <span class="badge badge-primary p-2">Status Transaksi : {{$data->status_transaksi}}</span>  </h5>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Tanggal Kirim</label>
                                    @if($data->tanggal_kirim != null)
                                        <h5 class="">  Dikirim Tanggal : <strong>  {{ \Carbon\Carbon::parse($data->tanggal_kirim)->format('d M Y') }} </strong> </h5>
                                    @else
                                        <h5 class=""> Dikirim Tanggal :  <strong> belum diisi </strong> </h5>
                                    @endif
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
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                    <td>Subtotal</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($detail_trans as $val)
                                    @php
                                        $subtotal = $val->harga * $val->jumlah_beli;
                                    @endphp
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            <a href="{{route('produk.show',$val->id_produk)}}">
                                                {{$val->nama_produk}}
                                            </a>
                                        </td>
                                        <td>Rp. {{ number_format($val->harga,0,',','.')}} </td>
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
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Update</strong> <span class="fw-300"><i>Transaksi Ini</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {!! Form::model($data,['route' => ['transaksi.update', $data->id_transaksi], 'method' => 'PUT', 'id' => 'form-transaksi', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="text-white">Data Update Transaksi</h5>
                                                <span>Update Status dan Tanggal Kirim Transaksi</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-12 col-md-4 col-form-label">Status Transaksi</label>
                                            <div class="col-sm-12 col-md-8">
                                                <select width="100%" class="form-control select2" name="status_transaksi" id="status_transaksi" required>
                                                    <option value="{{$data->status_transaksi}}" selected> Terpilih -  {{$data->status_transaksi}} </option>
                                                    <option value="Menunggu">Menunggu</option>
                                                    <option value="Diproses">Diproses</option>
                                                    <option value="Selesai">Selesai</option>
                                                    <option value="Dibatalkan">Dibatalkan</option>
                                                </select>
                                                @error('status_transaksi')
                                                <div class="col-form-label">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-12 col-md-4 col-form-label">Tanggal Pengiriman</label>
                                            <div class="col-sm-12 col-md-8">
                                                {!! Form::date('tanggal_kirim', null, ['class' => 'form-control', $errors->has('tanggal_kirim') ? 'form-control-danger' : '', 'placeholder' => 'Tanggal jadwal']) !!}
                                                @error('tanggal_kirim')
                                                <div class="col-form-label">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-left">
                                            <div class="panel-content text-right py-2 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-muted p-4">
                                                <button onclick="saveData()" class="btn btn-info btn-sm waves-effect text-left"><i
                                                            class="fal fa-save"></i> Simpan Data
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        <strong id="title-table">Detail</strong> <span class="fw-300"><i>Bukti Bayar</i></span>
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
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <label class="form-label">Bukti Pembayaran</label>
                                    <div class="align-content-center text-center" style="margin-left: 30px;margin-right: 30px;">
                                        @if($data->bukti_bayar)
                                            <img id="previewFoto" class="img-fluid" src="{{ asset('img/bukti_bayar/'.$data->bukti_bayar) }}" height="250px" alt="">
                                        @else
                                            <img id="previewFoto" width="100%" height="250" src="{{asset('img/pegawai/padrao.png')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
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