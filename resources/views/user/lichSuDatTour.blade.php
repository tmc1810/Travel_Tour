@extends('layouts.moldUser')

@section('content')     
<style>
    h3{
        margin-bottom:20px;
        font-size: 30px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center; /* Căn giữa nội dung ô */
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<div class="container-lg">
<div style="margin: 300px 0; width: 90%;margin-left: 100px;">
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Lịch Sử Đặt Tour</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoai</th>
                            <th>Số Người</th>
                            <th>Ngày Đi</th>
                            <th>Ngày Đặt</th>
                            <th>Giá</th>
                            <th>Trạng Thái</th>
                            <th>Công Cụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datTours as $datTour)
                            <tr>
                                <td><center>{{ $datTour->tour->ten_tour }}</center></td>
                                <td><center>{{ $datTour->ho_ten }}</center></td>
                                <td><center>{{ $datTour->email }}</center></td>
                                <td><center>{{ $datTour->so_dien_thoai }}</center></td>
                                <td><center>{{ $datTour->so_nguoi }}</center></td>
                                <td><center>{{ $datTour->ngay_di }}</center></td>
                                <td><center>{{ $datTour->ngay_dat_tour}}</center></td>
                                <td><center>{{ number_format($datTour->tour->gia) }}</center><span>VND</span></td>
                                <td><center>{{ $datTour->trang_thai_dattour }}</center></td>
                                <td>
                                    <center>
                                        @include('user.huyDatTour')            
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
