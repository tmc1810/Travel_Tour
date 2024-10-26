<?php

namespace App\Http\Controllers;

use App\Models\GopY;
use Illuminate\Http\Request;

class GopYController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $gopYs= GopY::when($keyword, function($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%");
        })->get();

        return view('admin.QuanLyGopY.index', compact('gopYs', 'keyword'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'ho_ten' => 'required|max:100',
            'so_dien_thoai' => 'required|max:20',
            'email' => 'required|max:50',
            'noidung_gopy' => 'required',
        ]);

        $validatedData['trangthai'] = 'Chưa Phản Hồi';

        GopY::create($validatedData);

        return redirect()->route('aboutus')->with('success', 'Gửi góp ý thành công!');
    }
}
