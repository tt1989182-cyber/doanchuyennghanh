<!DOCTYPE html>
<html lang="vi">
<head>
    @include('frontend.layouts.head')
    @stack('styles')
</head>

<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="butterfly-container">
                <div class="butterfly">
                    <div class="left-wing"></div>
                    <div class="right-wing"></div>
                    <div class="body"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    @include('frontend.layouts.notification')

    <!-- Header -->
    @include('frontend.layouts.header')
    <!-- End Header -->

    <!-- Main content -->
    @yield('main-content')
    <!-- End main content -->

    @include('frontend.layouts.footer')

    <!-- ===== JS BẮT BUỘC ===== -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/slicknav.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nicesellect.js') }}"></script>
    <script src="{{ asset('frontend/js/flex-slider.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/active.js') }}"></script>

    @stack('scripts')
</body>
</html>
