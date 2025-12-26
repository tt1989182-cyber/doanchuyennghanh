@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Category;
    use App\Models\Wishlist;
    use App\Models\Cart;

    // Settings
    $settings = DB::table('settings')->get();

    // Categories (parent + child)
    $categories = Category::with('child_cat')
        ->whereNull('parent_id')
        ->get();

    // Default values
    $wishlistCount = 0;
    $cartCount = 0;
    $wishlistItems = collect();
    $wishlistTotal = 0;

    if (Auth::check()) {
        $wishlistCount = Wishlist::where('user_id', auth()->id())
            ->whereNull('cart_id')
            ->sum('quantity');

        $cartCount = Cart::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->sum('quantity');

        $wishlistItems = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->whereNull('cart_id')
            ->get();

        $wishlistTotal = Wishlist::where('user_id', auth()->id())
            ->whereNull('cart_id')
            ->sum('amount');
    }
@endphp

<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="top-left">
                        <ul class="list-main">
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

                                @if(Auth::user()->role === 'admin')
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
                                @foreach($categories as $cat)
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

                <!-- Wishlist + Cart -->
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('wishlist') }}" class="single-icon">
                                <i class="ti-heart"></i>
                                <span class="total-count">{{ $wishlistCount }}</span>
                            </a>
                        </div>

                        <div class="sinlge-bar shopping">
                            <a href="{{ route('cart') }}" class="single-icon">
                                <i class="ti-bag"></i>
                                <span class="total-count">{{ $cartCount }}</span>
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

                        {{-- Category menu --}}
                        @foreach($categories as $cat)
                            @if($cat->child_cat->count())
                                <li>
                                    <a href="{{ route('product-cat', $cat->slug) }}">
                                        {{ $cat->title }} <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="dropdown">
                                        @foreach($cat->child_cat as $sub)
                                            <li>
                                                <a href="{{ route('product-sub-cat', [$cat->slug, $sub->slug]) }}">
                                                    {{ $sub->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('product-cat', $cat->slug) }}">
                                        {{ $cat->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="{{ route('try.on') }}">Trải nghiệm</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
