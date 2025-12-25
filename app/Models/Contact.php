@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Danh sách tin nhắn liên hệ</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
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

        {{ $messages->links() }}
    </div>
</div>
@endsection
