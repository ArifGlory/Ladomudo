@extends('front.app')
@section('title', 'Home')

@section('content')

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="{{ asset('front-end/images/banner-01.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Selamat Datang di<br> Ladomudo</strong></h1>
                            <p class="m-b-40">Silakan cari produk hortikultura disini</p>
                            {{--<p><a class="btn hvr-hover" href="#">Shop New</a></p>--}}
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{ asset('front-end/images/banner-02.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Mudah , Cepat dan <br> Nyaman</strong></h1>
                            {{--<p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>--}}
                            {{-- <p><a class="btn hvr-hover" href="#">Shop New</a></p>--}}
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{ asset('front-end/images/banner-03.jpg')}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Selamat Datang di <br> Ladomudo</strong></h1>
                            {{-- <p class="m-b-40">See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.</p>--}}
                            {{--<p><a class="btn hvr-hover" href="#">Shop New</a></p>--}}
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                @foreach($kategori as $val)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-cat-box">
                            @if($val->foto_kategori)
                                <img class="img-fluid" src="{{ asset('img/kategori/'.$val->foto_kategori) }}" alt="" />
                            @else
                                <img class="img-fluid" src="{{ asset('img/pegawai/padrao.png') }}" alt="" />
                            @endif
                            <a class="btn hvr-hover" href="#"> {{$val->nama_kategori}} </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->


    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Produk terbaru</h1>
                        <p>Berikut adalah produk terbaru kami.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($produk as $val)
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="blog-box">
                            <a href="{{route('shop-detail',$val->id_produk)}}">
                                <div class="blog-img">
                                    @if($val->foto_produk)
                                        <img class="img-fluid" src="{{ asset('img/produk/'.$val->foto_produk) }}" alt="" />
                                    @else
                                        <img class="img-fluid" src="{{ asset('img/pegawai/padrao.png') }}" alt="" />
                                    @endif
                                </div>
                                <div class="blog-content">
                                    <div class="title-blog">
                                        <h3> {{$val->nama_produk}} </h3>
                                        <p> {{$val->deskripsi_produk}} </p>
                                    </div>
                                    <ul class="option-blog">
                                        {{-- <li><a href="#"><i class="far fa-heart"></i></a></li>--}}
                                        {{-- <li><a href="#"><i class="far fa-comments"></i></a></li>--}}
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Blog  -->

@endsection