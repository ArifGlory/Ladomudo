@extends('layouts.auth')
@section('title', 'Bukti Bayar')

@section('content')
    <div class="row">
        <div class="col-md-3 mt-5"></div>
        <div class="col-md-6 mt-5">
            <div class="card border-top-left-radius-0 border-top-right-radius-0">
                <div class="card-header bg-success">
                    <h4>  <span class="page-logo-text mr-1"><strong>Kirim Bukti Pembayaran</strong> </span> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('bukti-bayar.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input name="id_transaksi" value="{{$id_transaksi}}" type="hidden">
                                <div class="form-group row">
                                    <label class="col-12 col-md-4 col-form-label">Bukti Pembayaran</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input accept="image/*" required id="foto" class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                                        @error('foto')
                                        <div class="col-form-label">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
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
