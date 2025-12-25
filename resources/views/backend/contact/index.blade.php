@extends('backend.layouts.master')
@section('title','AURA || lIÊN HỆ')
@section('main-content')
<h3>Danh sách liên hệ</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Ngày gửi</th>
        </tr>
    </thead>

    <tbody>
 































@section('main-content')

<h3>Danh sách liên hệ</h3>



<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>

            <th>Họ tên</th>

            <th>Email</th>

            <th>Tiêu đề</th>

            <th>Nội dung</th>

            <th>Ngày gửi</th>

        </tr>

    </thead>



    <tbody>

        @foreach($messages as $item)

        <tr>

            <td>{{ $item->id }}</td>

            <td>{{ $item->name }}</td>

            <td>{{ $item->email }}</td>

            <td>{{ $item->subject }}</td>

            <td>{{ $item->message }}</td>

            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection


    </tbody>
</table>
@endsection
