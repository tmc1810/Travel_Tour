@extends('layouts.moldAdmin')

@section('content')
<div style="padding:30px; background-color: rgb(238, 238, 238); margin: -24px; height: 950px;">
    @include('includes.alert')

    @include('admin.QuanLyHoaDon.timkiemhoadon')<br>
    
    <div class="table" style="background-color:rgb(255, 255, 255); padding: 20px; border-radius:30px;">
        <div class="order">
            <div class="head">
                <h4 style="font-weight:600;">Quản lý Hóa Đơn</h4>
            </div>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th><center>Mã Hóa Đơn</center></th>
                        <th><center>Mã Tour</center></th>
                        <th><center>Mã Khách Hàng</center></th>
                        <th><center>Họ Tên</center></th>
                        <th><center>Email</center></th>
                        <th><center>Số Điện Thoại</center></th>
                        <th><center>Trạng Thái</center></th>
                        <th><center>Công Cụ</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hoaDonDatTours as $hoaDonDatTour)
                        <tr>
                            <td><center>{{ $hoaDonDatTour->id }}</center></td>
                            <td><center>{{ $hoaDonDatTour->datTour->id }}</center></td>
                            <td><center>{{ $hoaDonDatTour->datTour->id_khachhang }}</center></td>
                            <td><center>{{ $hoaDonDatTour->datTour->ho_ten }}</center></td>
                            <td><center>{{ $hoaDonDatTour->datTour->email }}</center></td>
                            <td><center>{{ $hoaDonDatTour->datTour->so_dien_thoai }}</center></td>
                            <td><center>{{ $hoaDonDatTour->trang_thai }}</center></td>
                            <td>
                                @include('admin.QuanLyHoaDon.xemhoadon', ['hoaDonDatTour' => $hoaDonDatTour])
                                @include('admin.QuanLyHoaDon.suahoadon')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
