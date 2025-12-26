<footer class="footer">

	<div class="footer-top section">
		<div class="container">
			<div class="row">

				<div class="col-lg-5 col-md-6 col-12">
					<div class="single-footer about">
						<div class="logo">
							<a href="{{ route('home') }}">
								<img src="{{ asset('images/logo.png') }}" alt="Logo">
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
							Hỗ trợ 24/7
							<span>
								@foreach($settings as $data)
									{{ $data->phone }}
								@endforeach
							</span>
						</p>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-12">
					<div class="single-footer links">
						<h4>Thông tin</h4>
						<ul>
							<li><a href="{{ route('about-us') }}">Về chúng tôi</a></li>
							<li><a href="{{ route('contact') }}">Liên hệ</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-12">
					<div class="single-footer links">
						<h4>Hỗ trợ</h4>
						<ul>
							<li><a href="#">Thanh toán</a></li>
							<li><a href="#">Hoàn tiền</a></li>
							<li><a href="#">Giao hàng</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-footer social">
						<h4>Liên hệ</h4>
						<p>Email: aurashop@gmail.com</p>

						<div class="footer-social-icons">
							<a href="#"><i class="fab fa-facebook-f"></i></a>
							<a href="#"><i class="fab fa-instagram"></i></a>
							<a href="#"><i class="fab fa-youtube"></i></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="copyright">
		<div class="container">
			<p>© AURA Jewelry</p>
		</div>
	</div>

</footer>

<!-- JS -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('frontend/js/slicknav.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl-carousel.js') }}"></script>
<script src="{{ asset('frontend/js/isotope/isotope.pkgd.min.js') }}"></script>

<script src="{{ asset('frontend/js/active.js') }}"></script>

@stack('scripts')
