@extends('frontend.layouts.master')
@section('title','AURA || TRANG CHỦ')

@section('main-content')

<!-- ===== HERO BANNER ===== -->
<section class="hero-banner">
    <img src="{{ asset('images/banner1.jpg') }}" alt="banner">
</section>

<!-- ===== PRODUCT AREA ===== -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Sản phẩm phổ biến</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="product-info">

                    <!-- FILTER -->
                    <div class="nav-main">
                        <ul class="filter-tope-group">
                            @php
                                $categories = DB::table('categories')
                                    ->where('status','active')
                                    ->where('is_parent',1)
                                    ->get();
                            @endphp

                            <button class="btn how-active1" data-filter="*">Tất cả</button>

                            @foreach($categories as $cat)
                                <button class="btn" data-filter=".cat{{ $cat->id }}">
                                    {{ $cat->title }}
                                </button>
                            @endforeach
                        </ul>
                    </div>

                    <!-- PRODUCTS -->
                    <div class="row isotope-grid">
                        @foreach($product_lists as $product)
                            @php
                                $photo = explode(',', $product->photo);
                                $after_discount = $product->price - ($product->price * $product->discount) / 100;
                            @endphp

                            <div class="col-md-4 col-lg-3 isotope-item cat{{ $product->cat_id }}">
                                <div class="single-product">

                                    <div class="product-img">
                                        <a href="{{ route('product-detail',$product->slug) }}">
                                            <img src="{{ $photo[0] }}" class="default-img">
                                            <img src="{{ $photo[0] }}" class="hover-img">
                                        </a>

                                        <div class="button-head">
                                            <div class="product-action">
                                                <a href="{{ route('add-to-wishlist',$product->slug) }}">
                                                    <i class="ti-heart"></i>
                                                </a>
                                            </div>
                                            <div class="product-action-2">
                                                <a href="{{ route('add-to-cart',$product->slug) }}">
                                                    Thêm vào giỏ
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-content">
                                        <h3>
                                            <a href="{{ route('product-detail',$product->slug) }}">
                                                {{ $product->title }}
                                            </a>
                                        </h3>
                                        <div class="product-price">
                                            <span>${{ number_format($after_discount) }}</span>
                                            <del>${{ number_format($product->price) }}</del>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- ================== STYLES ================== --}}
@push('styles')
<style>

/* Banner full page */
.hero-banner{
    width:100%;
    height:450px;
    overflow:hidden;
}
.hero-banner img{
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(90%);
}
@media(max-width:768px){
    .hero-banner{height:280px;}
}

/* Isotope */
.filter-tope-group{
    display:flex;
    gap:10px;
    justify-content:center;
    margin-bottom:30px;
}
.filter-tope-group button{
    border:1px solid #000;
    background:#fff;
    padding:6px 16px;
    cursor:pointer;
}
.filter-tope-group .how-active1{
    background:#000;
    color:#fff;
}

</style>
@endpush

{{-- ================== SCRIPTS ================== --}}
@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Isotope -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script>
$(window).on('load', function () {

    var $grid = $('.isotope-grid').isotope({
        itemSelector: '.isotope-item',
        layoutMode: 'fitRows'
    });

    $('.filter-tope-group').on('click', 'button', function () {
        $('.filter-tope-group button').removeClass('how-active1');
        $(this).addClass('how-active1');

        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });

});
</script>
@endpush
