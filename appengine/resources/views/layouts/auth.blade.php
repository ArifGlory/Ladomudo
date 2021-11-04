<!DOCTYPE html>
<html style="height: 100%;" lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title') | Ladomudo
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/app.bundle.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url(getSettingData('favicon')->value ?? '') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url(getSettingData('favicon')->value ?? '') }}">
    <link rel="mask-icon" href="{{ url(getSettingData('favicon')->value ?? '') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/page-login.css') }}">

    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/notifications/toastr/toastr.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('back-end/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<style>
    .my-bg {
        /* The image used */
        background-image: url('{{url('img/farm.jpg')}}');

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<body style="height: 100%;">
<div class="my-bg">
    @yield('content')
</div>

<script src="{{ asset('back-end/js/vendors.bundle.js') }}"></script>
<script src="{{ asset('back-end/js/app.bundle.js') }}"></script>
<script src="{{ asset('back-end/js/notifications/toastr/toastr.js') }}"></script>
<script src="{{ asset('back-end/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script !src="">
    function showLoading(bool) {
        if(bool) {
            $('#loading').show();
        } else {
            $('#loading').attr("style", "display: none !important");
        }
    }
    $(document).ready(function () {
        @if(session('pesan_status'))
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 100,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr['{{session('pesan_status.tipe')}}']('{{session('pesan_status.desc')}}', '{{session('pesan_status.judul')}}');
        @endif
    });
</script>
@stack('content')
</body>
</html>
