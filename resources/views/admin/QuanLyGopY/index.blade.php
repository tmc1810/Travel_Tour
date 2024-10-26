@extends('layouts.moldAdmin')

@section('content')
    @include('includes.alert')
        @include('admin.QuanLyGopY.timkiemgopy')            
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Quản lý góp ý</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Họ Tên</th>
                            <th>Email</th>
                            <th>Số Điện Thoai</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Phản Hồi</th>
                            <th><center>Công cụ</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gopYs as $gopY)
                            <tr>
                                <td><center>{{ $gopY->ho_ten }}</center></td>
                                <td><center>{{ $gopY->email }}</center></td>
                                <td><center>{{ $gopY->so_dien_thoai }}</center></td>
                                <td><center>{{ $gopY->trangthai }}</center></td>
                                <td><center>{{ $gopY->created_at->format('d-m-Y H:i:s')}}</center></td>
                                <td><center>{{ $gopY->updated_at->format('d-m-Y H:i:s')}}</center></td>
                                <td>
                                    <center>
                                        @include('admin.QuanLyGopY.xemchitietgopy')
                                        @if($gopY->trangthai == "Chưa Phản Hồi")
                                            <form action="{{ route('guiPhanHoi', ['id' => $gopY->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary fs-5"><i class='bx bx-envelope'></i></button>
                                            </form>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    