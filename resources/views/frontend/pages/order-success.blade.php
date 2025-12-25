@extends('frontend.layouts.master')

@section('title','Đặt hàng thành công')

@section('main-content')
<div class="container py-5 text-center">
    <h2 class="text-success mb-3"> Bạn đã đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã mua hàng tại shop chúng tôi.</p>

    <h4 class="mt-4">Mã theo dõi đơn hàng của bạn:</h4>

    <div style="font-size: 28px; font-weight: bold; color: #e67e22; margin-top: 10px;">
        {{ $order_number }}
    </div>

    <p class="mt-3">Bạn có thể dùng mã này để <a href="{{ route('order.track') }}">theo dõi đơn hàng</a> trong theo dõi đơn hàng.</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Về trang chủ</a>
</div>
@endsection
