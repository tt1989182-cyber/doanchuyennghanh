<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Trang chủ')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- ===== CSS CHỈ GIỮ CÁI CẦN ===== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    @stack('styles')
</head>

<body class="js">

    @include('frontend.layouts.notification')
    @include('frontend.layouts.header')

    @yield('main-content')

    @include('frontend.layouts.footer')

    <!-- ===== JS CHUẨN – KHÔNG 404 ===== -->

    <!-- jQuery CDN (ổn định Railway) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>

    <!-- ISOTOPE CDN (SỬA LỖI 404 CỦA BẠN) -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <!-- ACTIVE -->
    <script src="{{ asset('frontend/js/active.js') }}"></script>

    @stack('scripts')
</body>
</html>
