<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>
        @yield('title') | {{  getSettingData('web_name')->value ?? env('APP_NAME') }}
    </title>
    <meta name="keywords" content="Ladomudo">
    <meta name="description" content="Ladomudo">
    <meta name="author" content="Tapisdev">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('front-end/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('front-end/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/css/custom.css')}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>Hubungi Kami :- <a href="#"> {{  getSettingData('telephone')->value ?? env('APP_NAME') }}</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        <li><a href="#"><i class="fa fa-user s_color"></i> {{ Auth::user()->name ?? "Akun Saya" }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="login-box">
                    <a class="btn hvr-hover text-white" data-fancybox-close="" href="{{route('login')}}">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html"><img src="{{ asset('front-end/images/logo.png')}}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/tentang')}}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/shop')}}">Produk</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu">
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="badge">3</span>
                            <p>Keranjang Belanja</p>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <li>
                        <a href="#" class="photo"><img src="{{ asset('front-end/images/img-pro-01.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Delica omtantur </a></h6>
                        <p>1x - <span class="price">$80.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{ asset('front-end/images/img-pro-02.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Omnes ocurreret</a></h6>
                        <p>1x - <span class="price">$60.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{ asset('front-end/images/img-pro-03.jpg')}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Agam facilisis</a></h6>
                        <p>1x - <span class="price">$40.00</span></p>
                    </li>
                    <li class="total">
                        <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: $180.00</span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <form id="search-form" action="{{ route('shop') }}" method="GET">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </form>
        </div>
    </div>
</div>
<!-- End Top Search -->

@yield('content', 'Hello')

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-01.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-02.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-03.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-04.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-05.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-06.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-07.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-08.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-09.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('front-end/images/instagram-img-05.jpg')}}" alt="" />
                <div class="hov-in">
                    <a href="#">{{--<i class="fab fa-instagram"></i>--}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->

<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>Business Time</h3>
                        <ul class="list-time">
                            <li>Senin - Sabtu: 08.00 - 05.00</li>
                            <li>Minggu: <span>Tutup</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>Sosial Media</h3>
                        <p>Follow Sosial media Kami.</p>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>Tentang Ladomudo</h4>
                        <p>{{  getSettingData('web_description')->value ?? env('APP_NAME') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Kontak Kami</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Alamat : {{  getSettingData('address')->value ?? env('APP_NAME') }} </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Telepon: {{  getSettingData('telephone')->value ?? env('APP_NAME') }}  </p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="{{  getSettingData('email')->value ?? env('APP_NAME') }}">{{  getSettingData('email')->value ?? env('APP_NAME') }}</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->

<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="footer-company">All Rights Reserved. &copy; 2021 <a href="#">Ladomudo</a>
</div>
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{ asset('front-end/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('front-end/js/popper.min.js')}}"></script>
<script src="{{ asset('front-end/js/bootstrap.min.js')}}"></script>
<!-- ALL PLUGINS -->
<script src="{{ asset('front-end/js/jquery.superslides.min.js')}}"></script>
<script src="{{ asset('front-end/js/bootstrap-select.js')}}"></script>
<script src="{{ asset('front-end/js/inewsticker.js')}}"></script>
<script src="{{ asset('front-end/js/bootsnav.js.')}}"></script>
<script src="{{ asset('front-end/js/images-loded.min.js')}}"></script>
<script src="{{ asset('front-end/js/isotope.min.js')}}"></script>
<script src="{{ asset('front-end/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('front-end/js/baguetteBox.min.js')}}"></script>
<script src="{{ asset('front-end/js/form-validator.min.js')}}"></script>
<script src="{{ asset('front-end/js/contact-form-script.js')}}"></script>
<script src="{{ asset('front-end/js/custom.js')}}"></script>

<script>
    $(document).ready(function () {

        $("#keyword").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var keyword = $("#keyword").val();
                console.log("kata kunci : "+keyword);
            }
        });
    });
</script>

</body>

</html>