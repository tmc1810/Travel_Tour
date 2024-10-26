@extends('layouts.moldMain-User')

@section('content-min')
<div class="container">
    <h1 class="text-center my-4" style="color: #1f2f70">Cập Nhật Thông Tin Cá Nhân</h1>
    <div class="card mx-auto" style="max-width: 600px;"> <!-- Khung viền bao quanh -->
        <div class="card-body">
            <form action="{{ url('/thay-doi-thong-tin-user') }}" method="POST" enctype="multipart/form-data" style="background-color:aliceblue">
                @csrf
                <div class="mb-3">
                    <label for="ho_ten" class="form-label" style="color:black;">Họ và tên</label>
                    <input style="background-color:aliceblue; color:black;" type="text" class="form-control" name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" style="color:black;">Email</label>
                    <input style="background-color:aliceblue; color:black;" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="so_dien_thoai" class="form-label" style="color:black;">Số điện thoại</label>
                    <input style="background-color:aliceblue; color:black;" type="text" class="form-control" name="so_dien_thoai" value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label" style="color:black;">Ảnh đại diện</label>
                    <input style="background-color:aliceblue; color:black;" type="file" class="form-control" name="avatar">
                </div>
                <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection