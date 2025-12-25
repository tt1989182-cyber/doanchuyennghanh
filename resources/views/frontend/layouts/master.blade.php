<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">
	
	<!-- Preloader Butterfly -->
<!-- Preloader Butterfly -->
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
<!-- End Preloader -->
	
	@include('frontend.layouts.notification')
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layouts.footer')


@yield('content')

</body>
</html>