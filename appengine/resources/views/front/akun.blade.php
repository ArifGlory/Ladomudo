@extends('front.app')
@section('title', 'Akun Saya')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
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
                                <h3 class="mt-4">Akun Saya</h3>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="list-view">
                                    <div class="list-view-box">
                                        <div class="row">
                                           <div class="col-md-8">
                                               <div class="form-group">
                                                   <h3>Nama</h3>
                                                   <h5>{{$data->name}}</h5>
                                               </div>
                                               <div class="form-group">
                                                   <h3>Email</h3>
                                                   <h5>{{$data->email}}</h5>
                                               </div>
                                               <div class="form-group">
                                                   <h3>Telepon</h3>
                                                   <h5>{{$data->phone}}</h5>
                                               </div>
                                               <div class="form-group">
                                                   <h3>Alamat</h3>
                                                   <h5>{{$data->alamat}}</h5>
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
    </div>
    <!-- End Shop Page -->
@endsection