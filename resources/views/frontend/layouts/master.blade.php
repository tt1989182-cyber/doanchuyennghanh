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

    @stack('scripts')

</body>
</html>
