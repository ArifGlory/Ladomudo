@extends('layouts.app')
@section('title', 'Ubah Produk')

@push('css')
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/formplugins/select2/select2.bundle.css') }}">
@endpush

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><strong>{{  getSettingData('web_name')->value ?? env('APP_NAME') }}</strong> WebApp</a></li>
        <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
        <li class="breadcrumb-item active">Ubah Produk</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-circle'></i> Edit Produk
            <small>
                Silahkan ubah data kategori
            </small>
        </h1>
        <div class="btn-group btn-group-sm text-center float-right" jabatan="group">
            <a href="{{ route('produk.index') }}" class="btn btn-primary btn-mini waves-effect waves-light"><span class="fal fa-backward"></span> Kembali</a>
        </div>
    </div>
@endsection

@section('content')
    {!! Form::model($data,['route' => ['produk.update', $data->id_produk], 'method' => 'PUT', 'id' => 'form-pegawai', 'files' => true]) !!}
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-white">Data Produk</h5>
                                <span>Silahkan mengisi data Produk yang akan digunakan dalam fungsi aplikasi ini.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Kategori Produk</label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-control select2" name="id_kategori" id="id_kategori" required>
                                    <option value="{{$data->id_kategori}}">Terpilih -  {{$data->nama_kategori}} </option>
                                    @foreach($kategori as $val)
                                        <option value="{{$val->id_kategori}}"> {{$val->nama_kategori}} </option>
                                    @endforeach
                                </select>

                                @error('id_kategori')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Supplier Produk Ini</label>
                            <div class="col-sm-12 col-md-8">
                                <select class="form-control select2" name="id_supplier" id="id_supplier" required>
                                    <option value="{{$data->id_supplier}}"> Terpilih -  {{$data->nama_supplier}} </option>
                                    @foreach($supplier as $val)
                                        <option value="{{$val->id_supplier}}"> {{$val->nama_supplier}} </option>
                                    @endforeach
                                </select>

                                @error('id_supplier')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Nama Produk</label>
                            <div class="col-sm-12 col-md-8">
                                {!! Form::text('nama_produk', null, ['class' => 'form-control', $errors->has('nama_produk') ? 'form-control-danger' : '', 'placeholder' => 'Nama Produk'
                                , 'required' => 'required']) !!}
                                @error('nama_produk')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Harga Produk</label>
                            <div class="col-sm-12 col-md-8">
                                {!! Form::number('harga', null, ['class' => 'form-control', $errors->has('harga') ? 'form-control-danger' : '', 'placeholder' => 'harga'
                                , 'required' => 'required']) !!}
                                @error('harga')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Stok Produk</label>
                            <div class="col-sm-12 col-md-8">
                                {!! Form::number('stok', null, ['class' => 'form-control', $errors->has('stok') ? 'form-control-danger' : '', 'placeholder' => 'Stok dalam angka'
                                , 'required' => 'required']) !!}
                                @error('stok')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Deskripsi Produk</label>
                            <div class="col-sm-12 col-md-8">
                                {!! Form::textarea('deskripsi_produk', null, ['class' => 'form-control', $errors->has('deskripsi_produk') ? 'form-control-danger' : '', 'placeholder' => 'Deskripsi']) !!}
                                @error('deskripsi_produk')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Cara Penyimpanan</label>
                            <div class="col-sm-12 col-md-8">
                                {!! Form::text('cara_penyimpanan', null, ['class' => 'form-control', $errors->has('cara_penyimpanan') ? 'form-control-danger' : '', 'placeholder' => 'Contoh : Dalam Kulkas dll.'
                                , 'required' => 'required']) !!}
                                @error('cara_penyimpanan')
                                <div class="col-form-label">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-4 col-form-label">Foto Produk</label>
                            <div class="col-sm-12 col-md-8">
                                <input accept="image/*" required id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                                @error('foto')
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
@endsection
@push('scripts')
    @include('layouts.partials._helper_js')
    <script src="{{ asset('back-end/js/formplugins/select2/select2.bundle.js') }}"></script>
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
                    $('#form-pegawai').submit()
                    showLoading(true);
                }
            })
        }
        $('.select2').select2({
            width: '100%',
            placeholder: "Pilih.."
        })
    </script>
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
@endpush
