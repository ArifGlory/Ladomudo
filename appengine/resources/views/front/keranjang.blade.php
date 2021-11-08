@extends('front.app')
@section('title', 'Keranjang Belanja')

@php
    $total_semua = 0;
@endphp

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Keranjang</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/shop')}}">Produk</a></li>
                        <li class="breadcrumb-item active">Keranjang Belanja</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($keranjang as $val)
                                    @php
                                        $subtotal = $val->jumlah_beli * $val->harga;
                                        $total_semua = $total_semua + $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ asset('img/produk/'.$val->foto_produk) }}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{$val->nama_produk}}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>Rp. {{number_format($val->harga,0,',','.')}}</p>
                                        </td>
                                        <td class="quantity-box">
                                            {{$val->jumlah_beli}}
                                        </td>
                                        <td class="total-pr">
                                            <p> Rp. {{number_format($subtotal,0,',','.')}} </p>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="{{route('keranjang.hapus', $val->id_keranjang)}}">
                                                <i class="fas fa-times"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Summary</h3>
                       {{-- <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> $ 130 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 40 </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 10 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold"> $ 2 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>--}}
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Total Semua</h5>
                            <div class="ml-auto h5"> Rp. {{number_format($total_semua,0,',','.')}} </div>
                        </div>
                        <hr> </div>
                </div>
                @if(count($keranjang) > 0)
                    <div class="col-12 d-flex shopping-box"><a href="{{route('keranjang.checkout')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
                @else
                    <div class="col-12 d-flex shopping-box"><a href="#" class="ml-auto btn hvr-hover disabled">Keranjang kosong</a> </div>
                @endif
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection