<?php

namespace App\Http\Controllers;

use App\Models\TrangTinTuc;
use App\Models\TheLoai;
use App\Models\HinhAnhTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function index()
    {
        $theLoais = TheLoai::all();
        $trangTinTucs = TrangTinTuc::get();

        return view('user.trang_tintuc.index', compact('trangTinTucs', 'theLoais'));
    }

    public function timKiemTinTuc(Request $request)
    {
        $categories = $request->input('categories', []);

        // Lấy các tin tức thuộc thể loại đã chọn
        $trangTinTucs = TrangTinTuc::whereIn('id_theloai', $categories)->get();

        // Trả về dữ liệu dạng JSON
        return response()->json($trangTinTucs);
    }

    public function show(TrangTinTuc $trangTinTuc)
    {
        $relatedBlogs = TrangTinTuc::where('id','!=', $trangTinTuc->id)
                ->where('id_theloai', $trangTinTuc->id_theloai)
                ->get();
        $tours = Tour::with('hinhAnhTours')->get()->take(2);

        $trangTinTuc->incrementReadCount('doc');

        return view('user.trang_tintuc.show', compact('trangTinTuc','tours','relatedBlogs'));
    }

    public function statistic()
    {
        // Lấy số lượng đặt tour theo tháng
        $tourData = TrangTinTuc::count();

        return view('thong_ke_dat_tour', compact('tourData'));
    }

}