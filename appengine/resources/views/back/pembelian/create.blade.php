@extends('layouts.app')
@section('title', 'Tambah Pembelian')

@push('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/formplugins/select2/select2.bundle.css') }}">
@endpush

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><strong>{{  getSettingData('web_name')->value ?? env('APP_NAME') }}</strong> WebApp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pembelian.index') }}">Transaksi Pembelian</a></li>
        <li class="breadcrumb-item active">Tambah Pembelian</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-circle'></i> Tambah Pembelian
            <small>
                Silahkan isi data Pembelian
            </small>
        </h1>
        <div class="btn-group btn-group-sm text-center float-right" jabatan="group">
            <a href="{{ route('pembelian.index') }}" class="btn btn-primary btn-mini waves-effect waves-light"><span class="fal fa-backward"></span> Kembali</a>
        </div>
    </div>
@endsection

@section('content')
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white">Data Pembelian</h5>
                                <span>Silahkan mengisi data pembelian yang akan digunakan dalam fungsi aplikasi ini.</span>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="list-produk">

                            <div class="form-group row">
                                <label class="col-12 col-md-4 col-form-label">Pilih Produk</label>
                                <div class="col-sm-12 col-md-8">
                                    <select class="form-control select2" name="id_produk" id="produk" required>
                                        @foreach($produk as $val)
                                            <option value="{{$val->id_produk}}" data-harga_beli="{{$val->harga_beli}}"> {{$val->nama_produk}} - Rp. {{ number_format($val->harga_beli,0,',','.')}} /Kg </option>
                                        @endforeach
                                    </select>

                                    @error('list_produk')
                                    <div class="col-form-label">
                                        <strong>{{ "Anda harus memilih produk terlebih dahulu" }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-md-4 col-form-label">Jumlah Pembelian</label>
                                <div class="col-sm-12 col-md-8">
                                    <input id="jumlah_beli" class="form-control" type="number" placeholder="Jumlah pembelian" min="1" max="1000">
                                    @error('list_jumlah')
                                    <div class="col-form-label">
                                        <strong>{{ "Anda harus input jumlah pembelian" }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="panel-content text-right py-2 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-muted p-4">
                                <button id="btnAdd" type="button" class="btn btn-primary btn-sm waves-effect text-left"><i
                                            class="fal fa-plus"></i> Tambah Produk
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped w-100" id="pembelian-table">
                        <thead>
                        <tr>
                            <td width="2%">No.</td>
                            <td>Nama & Harga Pembelian</td>
                            <td>Jumlah Beli</td>
                            <td>Aksi</td>
                        </tr>
                        </thead>
                        <tbody id="body-pembelian">

                        </tbody>
                    </table>
                    <br>
                    <br>
                    <div class="text-right">
                        <h1 id="total-harga"></h1>
                    </div>
                </div>
                {!! Form::open(['route' => 'pembelian.store', 'method' => 'POST', 'id' => 'form-pembelian', 'files' => true]) !!}
                <div class="card-footer">
                    <input name="list_produk" id="list_produk" type="hidden">
                    <input name="list_jumlah" id="list_jumlah" type="hidden">
                    <div class="text-left">
                        <div class="panel-content text-right py-2 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-muted p-4">
                            <button onclick="saveData()" class="btn btn-info btn-sm waves-effect text-left"><i
                                        class="fal fa-save"></i> Simpan Data Pembelian
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    @include('layouts.partials._helper_js')
    <script src="{{ asset('back-end/js/formplugins/select2/select2.bundle.js') }}"></script>
    <script>
        var list_id_produk = [];
        var list_jumlah_beli = [];
        var no = 1;
        var total_harga = 0;

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
                    $('#form-pembelian').submit()
                    showLoading(true);
                }
            })
        }
        $('.select2').select2({
            width: '100%',
            placeholder: "Pilih.."
        });
        $('#produk').on('change', function() {
            /*var harga_beli = $('#produk').find(':selected').data('harga_beli');
            console.log("harga beli : "+harga_beli);*/
        });
        $("#btnAdd").click(function(){
            var id_produk = $("#produk option:selected").val();
            var nama_dan_harga = $("#produk option:selected").text();
            var jumlah_beli = $("#jumlah_beli").val();
            var rowCount = $('#pembelian-table tr').length;

            list_id_produk.push(id_produk);
            list_jumlah_beli.push(jumlah_beli);

            $("#list_produk").val(list_id_produk);
            $("#list_jumlah").val(list_jumlah_beli);

            $("#body-pembelian").append('' +
                '<tr>' +
                '<td>' +
                '' +(no++)+
                '</td>' +
                '<td>'+nama_dan_harga+'</td>'+
                '<td>'+jumlah_beli+'</td>'+
                '<td class="text-center"><a href="javascript:void(0);" class="removeBaris">Remove</a></td>'+
                '</tr>');
        });
        $("#body-pembelian").on('click','.removeBaris',function(){
            var rowCount = $('#pembelian-table tr').length;
            if(rowCount == 2){
                no = 1;
            }
            $(this).parent().parent().remove();
            list_jumlah_beli.pop();
            list_id_produk.pop();

            $("#list_produk").val(list_id_produk);
            $("#list_jumlah").val(list_jumlah_beli);

        });
    </script>
@endpush
