<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="thong_tin_ca_nhan" id="thong_tin_ca_nhan">
    @extends('layouts.moldUser')

    @section('content')
    @include('includes.alert')

    <div style="margin-top: 100px;">
        <div class="container px-5 mt-5">
            <div class="row gx-5">
                <div class="col col-md-3" style="margin-top:200px">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('thong_tin_ca_nhan_user') }}" class="text-decoration-none">Thông Tin Cá Nhân</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('doi_mat_khau_user') }}" class="text-decoration-none">Đổi Mật Khẩu</a>
                    </li>
                    <!-- Thêm các mục khác nếu cần -->
                </ul>
            </div>
            <div class="col-sm-6 col-md-8">
                @yield('content-min')
            </div>
        </div>
    </div>
    @endsection