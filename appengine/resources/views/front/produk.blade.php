@extends('front.app')
@section('title', 'Produk')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Produk</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left mt-1">
                                <h4>Menampilkan {{$count_produk}} hasil </h4>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($produk as $val)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <a href="{{url('shop/shop-detail/'.$val->id_produk)}}">
                                                    <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                           {{-- <p class="sale">Sale</p>--}}
                                                        </div>
                                                        @if($val->foto_produk)
                                                            <img class="img-fluid" src="{{ asset('img/produk/'.$val->foto_produk) }}" alt="" />
                                                        @else
                                                            <img class="img-fluid" src="{{ asset('img/pegawai/padrao.png') }}" alt="" />
                                                        @endif
                                                        <div class="">
                                                            <a href="{{url('shop/shop-detail/'.$val->id_produk)}}">
                                                                <ul>

<!--                                                                    <li><a href="{{--{{url('shop/shop-detail/'.$val->id_produk)}}--}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>-->
                                                                    {{--<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>--}}
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="why-text">
                                                        <h4> {{$val->nama_produk}}</h4>
                                                        <h5> Rp. {{number_format($val->harga,0,',','.')}} /Kg</h5>
                                                    </div>

                                            </div>
                                                </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
               {{-- <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Kategori</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <a href="#" class="list-group-item list-group-item-action"> Grocery  <small class="text-muted">(150) </small></a>
                                <a href="#" class="list-group-item list-group-item-action"> Grocery <small class="text-muted">(11)</small></a>
                                <a href="#" class="list-group-item list-group-item-action"> Grocery <small class="text-muted">(22)</small></a>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection