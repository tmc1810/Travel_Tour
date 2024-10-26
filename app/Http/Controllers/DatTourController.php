<?php

namespace App\Http\Controllers;

use App\Models\DatTour;
use App\Models\Tour;
use App\Models\NguoiDung;
use App\Models\HoaDonDatTour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DatTourController extends Controller
{
    public function index(Request $request)
    {
        $nguoiDungs = NguoiDung::all();
        $tours = Tour::all();

        $keyword = $request->input('keyword');
        $datTours = DatTour::when($keyword, function($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                        ->orWhere('id', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%");
        })->get();

        $datTours->map(function ($datTour) {
            $datTour->ngay_dat_tour = Carbon::parse($datTour->ngay_dat_tour)->format('d-m-Y H:i:s');
            $datTour->ngay_huy_tour = $datTour->ngay_huy_tour ? Carbon::parse($datTour->ngay_huy_tour)->format('d-m-Y H:i:s') : 'N/A';
            return $datTour;
        });

        return view('admin.QuanLyDatTour.index', compact('nguoiDungs', 'tours', 'datTours', 'keyword'));
    }

    public function indexUser(Request $request)
    {
        $nguoiDungs = NguoiDung::all();
        $tours = Tour::all();

        $userId = Auth::id();
        $datTours = DatTour::where('id_khachhang', $userId)->get();

        $datTours->map(function ($datTour) {
            $datTour->ngay_dat_tour = Carbon::parse($datTour->ngay_dat_tour)->format('d-m-Y H:i:s');
            return $datTour;
        });

        return view('user.lichSuDatTour', compact('nguoiDungs', 'tours','userId', 'datTours'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tour' => 'required|string',
            'ho_ten' => 'required|max:100',
            'email' => 'required|email|max:50',
            'so_dien_thoai' => 'required|max:20',
            'so_nguoi' => 'required',
            'ngay_di' => ['required', 'date'],
        ]);

        
        $data = $request->all();
        $data['trang_thai_dattour'] = 'Chờ xác nhận';
        $data['ngay_dat_tour'] = Carbon::now();
        

        if (Auth::check()) {
            $data['id_khachhang'] = (string) Auth::user()->id;
        }
        
        // Lấy tour cuối cùng dựa trên phần số của ma_tour
        $lastDatTour = DatTour::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_dattour")
        ->orderBy('so_dattour', 'desc')
        ->first();

        // Tính toán giá trị số thứ tự mới cho ma_tour
        $newNumber = $lastDatTour ? $lastDatTour->so_dattour + 1 : 1;

        // Gán giá trị ma_tour mới
        $data['id'] = 'DT-' . $newNumber;

        DatTour::create($data);

        return redirect()->back()->with(['success' => "Đặt Tour Thành công, chúng tôi sẽ xử lý yêu cầu của bạn ngay!"]);
    }

    public function xacNhan($id)
    {
        $datTour = DatTour::findOrFail($id);
        $datTour->id_nguoidung = Auth::user()->id;
        $datTour->trang_thai_dattour = 'Đã Xác Nhận';
        $datTour->save();

        // Lấy tour cuối cùng dựa trên phần số của ma_tour
        $lastHoaDonDatTour = HoaDonDatTour::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_hoadon")
        ->orderBy('so_hoadon', 'desc')
        ->first();

        // Tính toán giá trị số thứ tự mới cho ma_tour
        $newNumber = $lastHoaDonDatTour ? $lastHoaDonDatTour->so_hoadon + 1 : 1;

        $hoaDonData = [
            'id' => 'HD-' . $newNumber,
            'id_dattour' => $datTour->id,
            'phuong_thuc_thanh_toan' => 'Thanh toán trực tiếp tại quầy',  // Thiết lập mặc định phương thức thanh toán
            'trang_thai' => 'Chưa thanh toán',  // Trạng thái hóa đơn
        ];

        HoaDonDatTour::create($hoaDonData);

        return redirect()->route('quanlydattour')->with('success', 'Đã xác nhận đặt tour thành công');
    }

    // Phương thức hủy đặt tour
    public function huy($id)
    {
        $datTour = DatTour::findOrFail($id);
        $datTour->id_nguoidung = Auth::user()->id;
        $datTour->trang_thai_dattour = 'Đã Hủy';
        $datTour->ngay_huy_tour = now(); // Ghi lại thời gian hủy tour
        $datTour->save();

        return redirect()->route('quanlydattour')->with('success', 'Đã hủy đặt tour thành công');
    }

    public function huyUser($id)
    {
        $datTour = DatTour::findOrFail($id);
        $datTour->trang_thai_dattour = 'Đã Hủy';
        $datTour->ngay_huy_tour = now(); // Ghi lại thời gian hủy tour
        $datTour->save();

        return redirect()->route('lichSuDatTour')->with('success', 'Đã hủy đặt tour thành công');
    }
}
