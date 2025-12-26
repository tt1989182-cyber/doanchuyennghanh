@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Wishlist;

/* SETTINGS */
$settings = DB::table('settings')->first();

/* CATEGORY */
$categories = Category::with('child_cat')
    ->whereNull('parent_id')
    ->where('status','active')
    ->get();

/* COUNT */
$cartCount = 0;
$wishlistCount = 0;

if(Auth::check()){
    $cartCount = Cart::where('user_id',Auth::id())
        ->whereNull('order_id')
        ->sum('quantity');

    $wishlistCount = Wishlist::where('user_id',Auth::id())
        ->sum('quantity');
}
@endphp

<header class="header shop">

    {{-- TOP BAR --}}
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <ul class="list-main">
                        <li><i class="ti-headphone-alt"></i> {{ $settings->phone ?? '' }}</li>
                        <li><i class="ti-email"></i> {{ $settings->email ?? '' }}</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-12 text-right">
                    <ul class="list-main">
                        <li>
                            <i class="ti-location-pin"></i>
                            <a href="{{ route('order.track') }}">Theo dõi đơn hàng</a>
                        </li>

                        @auth
                            <li>
                                <i class="ti-user"></i>
                                <a href="{{ route('user.account') }}">Tài khoản</a>
                            </li>

                            @if(Auth::user()->role === 'admin')
                                <li>
                                    <a href="{{ route('admin') }}" target="_blank">Admin</a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('user.logout') }}">Đăng xuất</a>
                            </li>
                        @endauth

                        @guest
                            <li>
                                <a href="{{ route('login.form') }}">Đăng nhập</a> /
                                <a href="{{ route('register.form') }}">Đăng ký</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- MIDDLE --}}
    <div class="middle-inner">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-2 col-md-2 col-12">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('backend/img/logo2.jpg') }}" alt="logo">
                    </a>
                </div>

                <div class="col-lg-8 col-md-7 col-12">
                    <form action="{{ route('product.search') }}" method="POST" class="search-bar">
                        @csrf
                        <input type="search" name="search" placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit">
                            <i class="ti-search"></i>
                        </button>
                    </form>
                </div>

                <div class="col-lg-2 col-md-3 col-12 text-right">
                    <a href="{{ route('wishlist') }}" class="single-icon">
                        <i class="ti-heart"></i>
                        <span class="total-count">{{ $wishlistCount }}</span>
                    </a>

                    <a href="{{ route('cart') }}" class="single-icon">
                        <i class="ti-bag"></i>
                        <span class="total-count">{{ $cartCount }}</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- MENU --}}
    <div class="header-inner">
        <div class="container">
<nav class="navbar navbar-expand-md">

                <ul class="nav main-menu menu navbar-nav">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('about-us') }}">Giới thiệu</a></li>

                    <li>
                        <a href="{{ route('product-grids') }}">
                            Sản phẩm <i class="ti-angle-down"></i>
                        </a>
                        <ul class="dropdown">
                            @foreach($categories as $cat)
                                @if($cat->child_cat->count())
                                    <li>
                                        <a href="#">{{ $cat->title }}</a>
                                        <ul class="dropdown sub-dropdown">
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
                        </ul>
                    </li>

                    {{-- TRẢI NGHIỆM --}}
                    <li>
                        <a href="{{ route('try.on') }}">Trải nghiệm</a>
                    </li>

                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </nav>
        </div>
    </div>

</header>
