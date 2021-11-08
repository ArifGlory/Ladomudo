@extends('front.app')
@section('title', 'Transaksi Saya')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Transaksi</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
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
                                <h3 class="mt-4">Transaksi Saya</h3>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach($transaksi as $val)
                                                <div class="col-sm-6 col-md-6 col-lg-12 col-xl-12">
                                                    <div class="why-text full-width">
                                                        <h4> {{$no}}. &nbsp;&nbsp; Transaksi tanggal {{ \Carbon\Carbon::parse($val->created_at)->format('d M Y | H:i') }}</h4>
                                                        <h5>Total Pembayaran  Rp. {{ number_format($val->total_harga,0,',','.')}}</h5>
                                                        <br>
                                                        <br>
                                                        <p> <span class="badge badge-primary p-2">Status Transaksi : {{$val->status_transaksi}}</span>  </p>
                                                        <a class="btn hvr-hover" href="{{route('detail-transaksi',$val->id_transaksi)}}">Lihat</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $no++;
                                                @endphp
                                            @endforeach
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