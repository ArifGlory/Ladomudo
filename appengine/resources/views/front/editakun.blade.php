@extends('layouts.auth')
@section('title', 'Edit Akun')

@section('content')
    <div class="row">
        <div class="col-md-3 mt-5"></div>
        <div class="col-md-6 mt-5">
            <div class="card border-top-left-radius-0 border-top-right-radius-0">
                <div class="card-header bg-success">
                    <h4>  <span class="page-logo-text mr-1"><strong>Edit Akun Anda </strong> </span> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('update-akun') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Nama</label>
                                    {!! Form::text('name', $data->name, ['class' => 'form-control', $errors->has('name') ? 'form-control-danger' : '', 'placeholder' => 'your name'
                                    ,'required' => 'required']) !!}
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Handphone</label>
                                    {!! Form::text('phone', $data->phone, ['class' => 'form-control', $errors->has('phone') ? 'form-control-danger' : '', 'placeholder' => 'your phone'
                                    ,'required' => 'required']) !!}
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Alamat Rumah</label>
                                    {!! Form::textarea('alamat', $data->alamat, ['class' => 'form-control', $errors->has('alamat') ? 'form-control-danger' : '', 'placeholder' => 'alamat rumah anda'
                                    ,'required' => 'required']) !!}
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Alamat Pengiriman</label>
                                    {!! Form::textarea('alamat_pengiriman', $data->alamat_pengiriman, ['class' => 'form-control', $errors->has('alamat_pengiriman') ? 'form-control-danger' : '', 'placeholder' => 'alamat pengiriman'
                                    ,'required' => 'required']) !!}
                                    @error('alamat_pengiriman')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group text-left">
                                    @if (isset($_SESSION["error_login"]))
                                        <div class="alert alert-danger text-center msg" id="error">
                                            <strong>{{ $_SESSION["error_login"] }}</strong>
                                        </div>
                                    @endif
                                    {{--<strong>{{ $_SESSION["ngehe"] }}</strong>--}}
                                </div>
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-round"><span class="fal fa-sign-in"></span> Simpan</button>
                                        <br>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-3 mt-5"></div>
    </div>
@endsection
