@extends('layouts.moldMain-User')

@section('content-min')
<div class="container" >
    <h1 class="text-center my-4" style="color: #1f2f70">Đổi Mật Khẩu</h1>
    <div class="card mx-auto" style="max-width: 400px; height: 550px;"> <!-- Khung viền bao quanh -->
        <div class="card-body">
            <form action="{{ url('/doi-mat-khau-user') }}" method="POST" style="background-color:aliceblue">
                @csrf
                <div class="mb-3">
                    <label for="mat_khau_cu" class="form-label" style="color:black;">Mật khẩu cũ</label>
                    <input style="background-color:aliceblue; color:black;" type="password" class="form-control" name="mat_khau_cu" required>
                </div>
                <div class="mb-3">
                    <label for="mat_khau_moi" class="form-label" style="color:black;">Mật khẩu mới</label>
                    <input style="background-color:aliceblue; color:black;" type="password" class="form-control" name="mat_khau_moi" required>
                </div>
                <div class="mb-3">
                    <label for="mat_khau_moi_confirmation" class="form-label" style="color:black;">Xác nhận mật khẩu mới</label>
                    <input style="background-color:aliceblue; color:black;" type="password" class="form-control" name="mat_khau_moi_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</div>
@endsection
