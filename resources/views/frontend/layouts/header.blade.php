@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Cart;

// Settings
$settings = DB::table('settings')->get();

// Categories
$categories = Category::with('child_cat')
    ->whereNull('parent_id')
    ->get();

// Default
$wishlistCount = 0;
$cartCount = 0;

if (Auth::check()) {
    $wishlistCount = Wishlist::where('user_id', auth()->id())
        ->whereNull('cart_id')
        ->sum('quantity');

    $cartCount = Cart::where('user_id', auth()->id())
        ->whereNull('order_id')
        ->sum('quantity');
}
@endphp

<header class="header shop">

    {{-- Topbar --}}
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <ul class="list-main">
                        <li>
                            <i class="ti-headphone-alt"></i>
                            {{ $settings->first()->phone ?? '' }}
                        </li>
                        <li>
                            <i class="ti-email"></i>
                            {{ $settings->first()->email ?? '' }}
                        </li>
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
                                <a href="{{ route('user.account') }}">Hồ sơ</a>
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

    {{-- Middle --}}
    <div class="middle-inner">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-2">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('backend/img/logo2.jpg') }}" alt="logo">
                    </a>
                </div>

                <div class="col-lg-8">
                    <form action="{{ route('product.search') }}" method="POST" class="search-bar">
                        @csrf
                        <input type="search" name="search" placeholder="Tìm kiếm...">
                        <button type="submit">
                            <i class="ti-search"></i>
                        </button>
                    </form>
                </div>

                <div class="col-lg-2 text-right">
                    <a href="{{ route('wishlist') }}">
                        <i class="ti-heart"></i>
                        <span>{{ $wishlistCount }}</span>
                    </a>

                    <a href="{{ route('cart') }}">
                        <i class="ti-bag"></i>
                        <span>{{ $cartCount }}</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="header-inner">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <ul class="nav main-menu menu navbar-nav">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('about-us') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('product-grids') }}">Sản phẩm</a></li>

                    @foreach($categories as $cat)
                        @if($cat->child_cat->count())
                            <li>
                                <a href="#">{{ $cat->title }} <i class="ti-angle-down"></i></a>
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
                                <a href="{{ route('product-cat', $cat->slug) }}">{{ $cat->title }}</a>
                            </li>
                        @endif
                    @endforeach

                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </nav>
        </div>
    </div>

</header>
