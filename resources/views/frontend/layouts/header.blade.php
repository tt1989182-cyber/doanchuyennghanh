<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings = DB::table('settings')->get();
                            @endphp
                            <li>
                                <i class="ti-headphone-alt"></i>
                                @foreach($settings as $data) {{ $data->phone }} @endforeach
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                @foreach($settings as $data) {{ $data->email }} @endforeach
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <div class="right-content">
                        <ul class="list-main">
                            <li>
                                <i class="ti-location-pin"></i>
                                <a href="{{ route('order.track') }}">Theo dõi đơn hàng</a>
                            </li>

                            @auth
                                <li>
                                    <i class="ti-user"></i>
                                    <a href="{{ route('user.account') }}">Hồ sơ của tôi</a>
                                </li>

                                @if(Auth::user()->role == 'admin')
                                    <li>
                                        <i class="ti-user"></i>
                                        <a href="{{ route('admin') }}" target="_blank">Bảng theo dõi</a>
                                    </li>
                                @endif

                                <li>
                                    <i class="ti-power-off"></i>
                                    <a href="{{ route('user.logout') }}">Đăng xuất</a>
                                </li>
                            @endauth

                            @guest
                                <li>
                                    <i class="ti-power-off"></i>
                                    <a href="{{ route('login.form') }}">Đăng nhập /</a>
                                    <a href="{{ route('register.form') }}">Đăng ký</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Middle -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('backend/img/logo2.jpg') }}" alt="logo">
                        </a>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option>Tất cả danh mục</option>
                                @foreach(\App\Helpers\Helper::getAllCategory() as $cat)
                                    <option>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{ route('product.search') }}">
                                @csrf
                                <input name="search" placeholder="Tìm kiếm ở đây" type="search">
                                <button class="btnn" type="submit">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Cart -->
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('wishlist') }}" class="single-icon">
                                <i class="ti-heart"></i>
                                <span class="total-count">
                                    {{ \App\Helpers\Helper::wishlistCount() }}
                                </span>
                            </a>

                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>
                                            {{ count(\App\Helpers\Helper::getAllProductFromWishlist()) }} Items
                                        </span>
                                        <a href="{{ route('wishlist') }}">Danh sách yêu thích</a>
                                    </div>

                                    <ul class="shopping-list">
                                        @foreach(\App\Helpers\Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('wishlist-delete', $data->id) }}" class="remove">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                                <a class="cart-img" href="#">
                                                    <img src="{{ $photo[0] }}">
                                                </a>
                                                <h4>
                                                    <a href="{{ route('product-detail', $data->product['slug']) }}">
                                                        {{ $data->product['title'] }}
                                                    </a>
                                                </h4>
                                                <p class="quantity">
                                                    {{ $data->quantity }} x -
                                                    <span class="amount">
                                                        {{ number_format($data->price, 0, ',', '.') }} ₫
                                                    </span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="bottom">
                                        <div class="total">
                                            <span>Tổng</span>
                                            <span class="total-amount">
                                                {{ number_format(\App\Helpers\Helper::totalWishlistPrice(), 0, ',', '.') }} ₫
                                            </span>
                                        </div>
                                        <a href="{{ route('cart') }}" class="btn animate">Thanh toán</a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Cart -->
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('cart') }}" class="single-icon">
                                <i class="ti-bag"></i>
                                <span class="total-count">
                                    {{ \App\Helpers\Helper::cartCount() }}
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="header-inner">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="nav-inner">
                    <ul class="nav main-menu menu navbar-nav">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('about-us') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('product-grids') }}">Sản phẩm</a></li>

                        {!! \App\Helpers\Helper::getHeaderCategory() !!}

                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="{{ route('try.on') }}">Trải nghiệm</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
