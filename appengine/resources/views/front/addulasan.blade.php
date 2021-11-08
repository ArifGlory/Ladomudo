@extends('layouts.auth')
@section('title', 'Buat Ulasan')

@section('content')
    <div class="row">
        <div class="col-md-3 mt-5"></div>
        <div class="col-md-6 mt-5">
            <div class="card border-top-left-radius-0 border-top-right-radius-0">
                <div class="card-header bg-success">
                    <h4>  <span class="page-logo-text mr-1"><strong>Buat Ulasan Produk {{$data->nama_produk}} </strong> </span> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('ulasan.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input name="id_produk" value="{{$data->id_produk}}" type="hidden">

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Ulasan</label>
                                    {!! Form::textarea('ulasan', null, ['class' => 'form-control', $errors->has('ulasan') ? 'form-control-danger' : '', 'placeholder' => 'Ulasan produk ini'
                                    ,'required' => 'required']) !!}
                                    @error('ulasan')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="alamat">Rating</label>
                                    <select required class="form-control" name="rating">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                    @error('rating')
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
