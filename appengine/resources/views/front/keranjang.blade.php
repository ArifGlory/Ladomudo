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
                                <th>Diskon</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($keranjang as $val)
                                    @php
                                        $potongan = ($val->diskon/100) * $val->harga;
                                        $harga_setelah_diskon = $val->harga - $potongan;

                                        $subtotal = $val->jumlah_beli * $harga_setelah_diskon;
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
                                            {{$val->diskon}} %
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
                            <div class="ml-auto h5">
                                <h2 id="text-total">Rp. {{number_format($total_semua,0,',','.')}} </h2>
                            </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{route('keranjang.checkout')}}" >
                            @csrf
                            <div class="form-group">
                                <h5>Anda harus memilih lokasi pengiriman dahulu, sebelum melakukan checkout</h5>
                            </div>
                            <div class="form-group">
                                <label>Lokasi Pengiriman</label>
                                <select class="form-control" id="select-ongkir" name="ongkir" required>
                                    @foreach($ongkir as $val)
                                        <option value="{{$val->ongkir}}"> {{$val->nama_kota}} , Rp. {{number_format($val->ongkir,0,',','.')}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @if(count($keranjang) > 0)
                                    <div class="pull-left text-white">
                                        <button type="submit" class="ml-auto btn btn-primary">Checkout</button>
                                    </div>
                                @else
                                    <div class="col-12 d-flex shopping-box"><a href="#" class="ml-auto btn hvr-hover disabled">Keranjang kosong</a> </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@endsection
@push('scripts')
    <script>
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        var total_semua = '{{$total_semua}}';
        total_semua = parseInt(total_semua);
        var jumlah_total = 0;
        console.log("total semua = "+total_semua);

        $('#select-ongkir').on("change",function () {
            var ongkir = $(this).val();
            ongkir = parseInt(ongkir);
            jumlah_total = total_semua + ongkir;
            $('#text-total').text(rupiah(jumlah_total));
        });

    </script>
@endpush