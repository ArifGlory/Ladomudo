@extends('front.app')
@section('title', 'Tentang')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ABOUT US</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tentang kami</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-fluid" src="{{ asset('front-end/images/about-img.jpg')}}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="noo-sh-title-top">Kami <span>LadoMudo</span></h2>
                    <p>Gudang Hortikultura Ladomudo merupakan usaha bidang jual beli hasil tanaman hortikultura berupa sayur-sayuruan
                        dan buah-buahan di desa gisting, kecamatan gisting, kabupaten Tangggamus. Proses bisnis yang dijalankan oleh Gudang Hortikultura Ladomudo dimulai dari membeli hasil pertanian dari petani berupa sayur-sayuran dan buah-buahan kemudian
                        menjualnya kembali ke pedagang atau masyarakat umum lainya dengan para konsumen mendatangi langsung ke Gudang Ladomudo. </p>

                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Kami Terpercaya</h3>
                        <p>  </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Kami Profesional</h3>
                        <p> </p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="service-block-inner">
                        <h3>Kami Expert</h3>
                        <p>  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Page -->
@endsection