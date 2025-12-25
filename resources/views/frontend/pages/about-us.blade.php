@extends('frontend.layouts.master')

@section('title','AURA || Giới thiệu về chúng tôi')

@section('main-content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Trang chủ<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">Về chúng tôi</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<h3>Chào mừng bạn đến với <span>Trang sức AURA</span></h3>
							<p>Trang sức AURA tự hào mang đến những sản phẩm trang sức tinh xảo, sang trọng với chất lượng cao cấp. Chúng tôi cam kết sử dụng những nguyên liệu quý hiếm cùng thiết kế độc đáo, tạo nên những tác phẩm nghệ thuật hoàn hảo cho khách hàng.</p>
							<div class="button">

								<a href="{{route('contact')}}" class="btn primary">Liên hệ với chúng tôi</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
   <div class="about-img overlay">
    <div class="video-container">
        <video width="100%" height="auto" controls autoplay muted loop>
            <<source src="{{ asset('frontend/img/about.mp4') }}" type="video/mp4">
        
        </video>
    </div>
</div>
        </iframe>
    </div>
</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->


	<!-- Start Shop Services Area -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Miễn phí vận chuyển</h4>
						<p>Khi đặt hàng trên 1.000.000đ</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Miễn phí trả hàng</h4>
						<p>Trong vòng 15 ngày</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Thanh toán an toàn</h4>
						<p>100% an toàn</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Giá tốt nhất</h4>
						<p>Giá đảm bảo</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	@include('frontend.layouts.newsletter')
@endsection
