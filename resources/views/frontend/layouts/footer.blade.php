<!-- Start Footer Area -->
<footer class="footer">

	<!-- Footer Top -->
	<div class="footer-top section">
		<div class="container">
			<div class="row">

				<!-- About -->
				<div class="col-lg-5 col-md-6 col-12">
					<div class="single-footer about">
						<div class="logo">
							<a href="index.html">
								<img src="{{ asset('backend/img/logo1.jpg') }}" alt="Logo">
							</a>
						</div>

						@php
							$settings = DB::table('settings')->get();
						@endphp

						<p class="text">
							@foreach($settings as $data)
								{{ $data->short_des }}
							@endforeach
						</p>

						<p class="call">
							Luôn trả lời câu hỏi 24/7
							<span>
								<a href="tel:0795532120">
									@foreach($settings as $data)
										{{ $data->phone }}
									@endforeach
								</a>
							</span>
						</p>
					</div>
				</div>

				<!-- Info -->
				<div class="col-lg-2 col-md-6 col-12">
					<div class="single-footer links">
						<h4>Thông tin</h4>
						<ul>
							<li><a href="{{ route('about-us') }}">Về chúng tôi</a></li>
							<li><a href="#">Câu hỏi</a></li>
							<li><a href="#">Điều khoản & Điều kiện</a></li>
							<li><a href="{{ route('contact') }}">Liên hệ</a></li>
							<li><a href="#">Giúp đỡ</a></li>
						</ul>
					</div>
				</div>

				<!-- Customer Care -->
				<div class="col-lg-2 col-md-6 col-12">
					<div class="single-footer links">
						<h4>Chăm sóc khách hàng</h4>
						<ul>
							<li><a href="#">Phương thức thanh toán</a></li>
							<li><a href="#">Hoàn tiền</a></li>
							<li><a href="#">Trả hàng</a></li>
							<li><a href="#">Giao hàng</a></li>
							<li><a href="#">Chính sách bảo mật</a></li>
						</ul>
					</div>
				</div>

				<!-- Contact + Social -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-footer social">
						<h4>Liên hệ</h4>
						<p>Hotline: 079-553-2120</p>
						<p>Email: aurashop@gmail.com</p>

						<div class="footer-social-icons">
	<a href="https://www.facebook.com/letrinh.tranhoang.9" 
	   target="_blank" 
	   title="Facebook cá nhân">
		<i class="fab fa-facebook-f"></i>
	</a>

	<a href="https://www.instagram.com/tranhoangletrinh/" 
	   target="_blank" 
	   title="Instagram">
		<i class="fab fa-instagram"></i>
	</a>

	<a href="https://www.youtube.com/@123thd5" 
	   target="_blank" 
	   title="YouTube">
		<i class="fab fa-youtube"></i>
	</a>
</div>

					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- End Footer Top -->

	<!-- Copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12">
					<p>Trang sức – vẻ đẹp của phụ nữ</p>
				</div>
			</div>
		</div>
	</div>

</footer>
<!-- End Footer Area -->


<!-- ========== FONT AWESOME (BẮT BUỘC) ========== -->
<link rel="stylesheet"
	  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<!-- ========== CSS ICON SOCIAL ========== -->
<style>
.footer-social-icons a {
	display: inline-block;
	width: 40px;
	height: 40px;
	line-height: 40px;
	text-align: center;
	border-radius: 50%;
	background: #222;
	color: #fff;
	margin-right: 10px;
	transition: 0.3s;
}

.footer-social-icons a:hover {
	background: #3b5998;
	color: #fff;
}
</style>


<!-- ========== JS ========== -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/colors.js') }}"></script>
<script src="{{ asset('frontend/js/slicknav.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
<script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/finalcountdown.min.js') }}"></script>
<script src="{{ asset('frontend/js/nicesellect.js') }}"></script>
<script src="{{ asset('frontend/js/flex-slider.js') }}"></script>
<script src="{{ asset('frontend/js/scrollup.js') }}"></script>
<script src="{{ asset('frontend/js/onepage-nav.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/easing.js') }}"></script>
<script src="{{ asset('frontend/js/active.js') }}"></script>

@stack('scripts')

<script>
	setTimeout(function () {
		$('.alert').slideUp();
	}, 5000);
</script>
