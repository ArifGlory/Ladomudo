@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
    <div class="row">
        <div class="col-md-3 mt-5"></div>
        <div class="col-md-6 mt-5">
            <div class="card border-top-left-radius-0 border-top-right-radius-0">
                <div class="card-header bg-success">
                    <h4>  <span class="page-logo-text mr-1"><strong>Daftar Akun Ladomudo</strong> </span> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('daftar.simpan') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama anda.."
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="phone">Telepon</label>
                                    <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan telepon anda.."
                                           value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    {!! Form::textarea('alamat', null, ['class' => 'form-control', $errors->has('alamat') ? 'form-control-danger' : '', 'placeholder' => 'Alamat']) !!}
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email anda.."
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="help-block">
                            Email anda yang digunakan untuk login apps
                        </span>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
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
                                        <button type="submit" class="btn btn-success btn-round"><span class="fal fa-sign-in"></span> Register</button>
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
