<?php

namespace App\Http\Controllers;

use App\Models\LoaiTour;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $loaiTours = LoaiTour::all();

        $keyword = $request->input('keyword');
        $tours = Tour::when($keyword, function($query) use ($keyword) {
            return $query->where('ten_tour', 'LIKE', "%{$keyword}%")
                        ->orWhere('id', 'LIKE', "%{$keyword}%")
                        ->orWhere('thoigian_tour', 'LIKE', "%{$keyword}%")
                        ->orWhere('noi_khoi_hanh', 'LIKE', "%{$keyword}%");
        })->get();

        return view('admin.QuanLyTour.index', compact('tours', 'keyword', 'loaiTours'));
    }

    public function create()
    {
        return view('admin.QuanLyTour.themTour');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'ten_tour' => 'required|string',
            'id_LoaiTour' => 'required|integer',
            'thoigian_tour' => 'required|string',
            'noi_khoi_hanh' => 'required|string',
            'gia' => 'required|numeric',
            'slug' => 'required|string',
            'mo_ta' => 'nullable|string',
        ]);
    
        // Lấy tour cuối cùng dựa trên phần số của ma_tour
        $lastTour = Tour::selectRaw("CAST(SUBSTRING(id, 3) AS UNSIGNED) as so_tour")
        ->orderBy('so_tour', 'desc')
        ->first();

        // Tính toán giá trị số thứ tự mới cho ma_tour
        $newNumber = $lastTour ? $lastTour->so_tour + 1 : 1;

        // Gán giá trị ma_tour mới
        $validatedData['id'] = 'T-' . $newNumber;

        // Create the tour with ma_tour as the primary key
        Tour::create($validatedData);

        return redirect()->route('quanlytour')->with('success', 'Thêm tour thành công!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'ten_tour' => 'required|string',
            'id_LoaiTour' => 'required|integer',
            'thoigian_tour' => 'required|string',
            'noi_khoi_hanh' => 'required|string',
            'gia' => 'required|numeric',
            'slug' => 'required|string',
            'mo_ta' => 'nullable|string',
        ]);
    
        $tour = Tour::findOrFail($id);

        $tour->ten_tour = $request->ten_tour;
        $tour->id_LoaiTour = $request->id_LoaiTour;
        $tour->thoigian_tour = $request->thoigian_tour;
        $tour->noi_khoi_hanh = $request->noi_khoi_hanh;
        $tour->gia = $request->gia;
        $tour->slug = $request->slug;
        $tour->mo_ta = $request->mo_ta;

        $tour->save();

        return redirect()->route('quanlytour')->with('success', 'Sửa tour thành công!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete(); 
        
        return redirect()->route('quanlytour')->with('success', 'Xóa tour thành công!');   
    }
}
