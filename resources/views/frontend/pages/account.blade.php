@extends('frontend.layouts.master')

@section('main-content')
<style>
    .profile-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 1px solid #f1f1f1;
        max-width: 600px;
        margin: 40px auto;
    }
    .profile-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .profile-header h3 {
        font-weight: 600;
        font-size: 26px;
        color: #333;
    }
    .profile-info p {
        font-size: 18px;
        margin: 10px 0;
        color: #555;
    }
    .profile-info strong {
        color: #222;
    }
    .profile-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #f1f1f1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
        font-size: 40px;
        color: #777;
    }
</style>

<div class="profile-card">
    <div class="profile-header">
        <div class="profile-icon">
            <i class="fas fa-user"></i>
        </div>
        <h3>Hồ sơ tài khoản</h3>
    </div>

    <div class="profile-info">
        <p><strong>Tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>
</div>

@endsection
