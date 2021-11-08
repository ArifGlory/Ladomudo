@extends('front.app')
@section('title', 'Detail produk')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Detail Produk</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/shop')}}">Produk</a></li>
                        <li class="breadcrumb-item active">Detail Produk </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                @if($data->foto_produk)
                                    <img class="d-block w-100" src="{{ asset('img/produk/'.$data->foto_produk) }}" alt="First slide">
                                @else
                                    <img class="d-block w-100" src="{{ asset('img/pegawai/padrao.png') }}" alt="First slide" />
                                @endif
                            </div>
                            {{--<div class="carousel-item"> <img class="d-block w-100" src="images/big-img-02.jpg" alt="Second slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="images/big-img-03.jpg" alt="Third slide"> </div>--}}
                        </div>
                        {{--<a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>--}}
                        {{--<ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-01.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="1">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-02.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="2">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-03.jpg" alt="" />
                            </li>
                        </ol>--}}
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    {!! Form::open(['route' => 'keranjang.store', 'method' => 'POST', 'id' => 'form-produk', 'files' => true]) !!}
                        <div class="single-product-details">
                            <h2> {{$data->nama_produk}} &nbsp;&nbsp; <i class="fa fa-star" style="color: #fbc02d;"></i> {{$rating}} </h2>
                            <h4 class="mt-0"> Kategori  {{$data->nama_kategori}} </h4>
                            <h5 class="mt-4"> <del> Rp . {{number_format($data->harga,0,',','.')}} /Kg </del> &nbsp; Rp . {{number_format($harga_setelah_diskon,0,',','.')}} </h5>
                            <p class="available-stock"><span> Stok Tersisa {{$data->stok}} available</span><p>
                            <h4>Deskripsi:</h4>
                            <p> {{$data->deskripsi_produk}}
                            </p>
                            <h5 class="text-black-50">Manfaat : </h5>
                            <p> {{$data->manfaat_produk}}
                            </p>
                            <ul>
                                <input name="id_produk" type="hidden" value="{{$data->id_produk}}">
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Jumlah Pembelian (Kg) </label>
                                        <input required name="jumlah_beli" class="form-control" value="0" min="1" max="{{$data->stok}}" type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <button class="ml-auto btn hvr-hover text-white"  type="submit">Tambah ke Keranjang</button>
                                </div>
                            </div>

                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="row my-5">
                <div class="col-md-12">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            <h2>Ulasan Produk</h2>
                        </div>
                        <div class="card-body">
                            @if(count($ulasan) == 0)
                                <div class="media mb-3">
                                    <div class="mr-2">
                                    </div>
                                    <div class="media-body">
                                        <p class="mt-4"> Belum ada ulasan untuk saat ini </p>
                                    </div>
                                </div>
                            @endif
                            @foreach($ulasan as $val)
                                <div class="media mb-3">
                                    <div class="mr-2">
                                        @if($val->foto)
                                            <img height="100" width="100" class="rounded-circle border p-1" src="{{ asset('img/user/'.$val->foto) }}" alt="user foto">
                                        @else
                                            <img class="rounded-circle border p-1" src="{{ asset('img/user/padrao.png') }}" alt="user foto" />
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p class="mt-3"> {{$val->ulasan}} </p>
                                        <small class="text-muted">Oleh {{$val->name}} pada {{ \Carbon\Carbon::parse($val->created_at)->format('d M Y') }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <a href="{{route('add-ulasan',$data->id_produk)}}" class="btn hvr-hover">Berikan Ulasan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
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
                    $('#form-produk').submit()
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