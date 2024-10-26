<?php

namespace App\Http\Controllers;

use App\Models\HoaDonDatTour;
use App\Models\NguoiDung;
use App\Models\DatTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index(Request $request)
    {
        $datTours = DatTour::all();
        $keyword = $request->input('keyword');

        // Fetch invoices based on search criteria
        $hoaDonDatTours = HoaDonDatTour::when($keyword, function ($query) use ($keyword) {
            return $query->where('id', 'LIKE', "%{$keyword}%")
                         ->orWhereHas('datTour', function ($q) use ($keyword) {
                             $q->where('ho_ten', 'LIKE', "%{$keyword}%")
                               ->orWhere('email', 'LIKE', "%{$keyword}%")
                               ->orWhere('id', 'LIKE', "%{$keyword}%")
                               ->orWhere('id_khachhang', 'LIKE', "%{$keyword}%")
                               ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%");
                         });
        })->get();
        return view('admin.QuanLyHoaDon.index', compact('hoaDonDatTours', 'datTours', 'keyword'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phuong_thuc_thanh_toan' => 'required',
            'trang_thai' => 'required',
        ]);

        $hoaDonDatTour = HoaDonDatTour::findOrFail($id);
        $hoaDonDatTour->phuong_thuc_thanh_toan = $request->phuong_thuc_thanh_toan;
        $hoaDonDatTour->trang_thai = $request->trang_thai;

        $hoaDonDatTour->save();
    
        return redirect()->route('hoadondattour')->with('success', 'Cập nhật hóa đơn thành công!');
    }
}
