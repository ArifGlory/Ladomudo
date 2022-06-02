@extends('front.app')
@section('title', 'Detail Transaksi')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Detail Transaksi</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/akun-saya')}}">Transaksi saya</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12  col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-left text-sm-left">
                                <h2 class="mt-4">Detail Transaksi Tanggal {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y | H:i') }}</h2>
                                <h3> <strong> Total Pembayaran Rp. {{ number_format($transaksi->total_harga,0,',','.')}} </strong></h3>
                                <h1> <span class="badge badge-primary p-2">Status Transaksi : {{$transaksi->status_transaksi}}</span>  </h1>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                @if($transaksi->tanggal_kirim != null)
                                    <h3 class="mt-4">  Dikirim Tanggal : <strong>  {{ \Carbon\Carbon::parse($transaksi->tanggal_kirim)->format('d M Y') }} </strong> </h3>
                                @else
                                    <h3 class="mt-4"> Dikirim Tanggal :  <strong> menunggu informasi </strong> </h3>
                                @endif
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                            @foreach($detail_trans as $val)
                                                @php
                                                    $potongan = ($val->diskon/100) * $val->harga;
                                                    $harga_setelah_diskon = $val->harga - $potongan;

                                                    //$subtotal = $val->jumlah_beli * $val->harga;
                                                    $subtotal = $val->jumlah_beli * $harga_setelah_diskon;
                                                @endphp
                                                <div class="col-sm-6 col-md-6 col-lg-9 col-xl-9">
                                                    <div class="why-text full-width">
                                                        <h4>{{$val->nama_produk}}</h4>
                                                        <h5> {{$val->jumlah_beli}} Kg @ Rp. {{ number_format($subtotal,0,',','.')}}</h5>
                                                        <br>
                                                        <br>
                                                        <p>{{$val->deskripsi_produk}}
                                                        <br>
                                                            {{$val->manfaat_produk}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            @if($val->foto_produk)
                                                                <img class="img-fluid" width="150" src="{{ asset('img/produk/'.$val->foto_produk) }}" alt="" />
                                                            @else
                                                                <img class="img-fluid" width="150" src="{{ asset('img/pegawai/padrao.png') }}" alt="" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12  col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-left text-sm-left">
                                <h2 class="mt-4">Bukti Pembayaran</h2>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-9 col-xl-9">
                                                <div class="why-text full-width">
                                                    @if($transaksi->bukti_bayar)
                                                        <img class="img-fluid" width="250" src="{{ asset('img/bukti_bayar/'.$transaksi->bukti_bayar) }}" alt="" />
                                                    @else
                                                        <img class="img-fluid" width="250" src="{{ asset('img/pegawai/padrao.png') }}" alt="" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <a class="btn hvr-hover text-white" href="{{route('bukti-bayar',$transaksi->id_transaksi)}}">Kirim Bukti Bayar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection