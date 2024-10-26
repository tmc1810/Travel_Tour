@extends('layouts.moldMain-User')

@section('content-min')

<h1 class="text-center mb-3" style="color: #1f2f70">Thông Tin Cá Nhân</h1>
<div class="card">
    <div class="card-body text-center">
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px;" />
        <h2 class="card-title" style="color: #1f2f70">{{ $user->ho_ten }}</h2>
        <p class="card-text" style="color:black">Tài khoản: <strong>{{ $user->tai_khoan }}</strong></p>
        <p class="card-text" style="color:black">Email: <strong>{{ $user->email }}</strong></p>
        <p class="card-text" style="color:black">Số điện thoại: <strong>{{ $user->so_dien_thoai }}</strong></p>
        <p class="card-text" style="color:black">Vai trò: <strong>{{ $user->vai_tro }}</strong></p>
        <a href="{{ route('thay_doi_thong_tin_user') }}" class="btn btn-primary">Cập nhật thông tin</a>
    </div>
</div>
@endsection


