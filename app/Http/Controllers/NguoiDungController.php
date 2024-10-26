<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NguoiDungRequest;

class NguoiDungController extends Controller
{
    // Hiển thị danh sách người dùng (index)
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $nguoiDungs = NguoiDung::when($keyword, function($query) use ($keyword) {
            return $query->where('ho_ten', 'LIKE', "%{$keyword}%")
                         ->orWhere('id', 'LIKE', "%{$keyword}%")
                         ->orWhere('tai_khoan', 'LIKE', "%{$keyword}%")
                         ->orWhere('so_dien_thoai', 'LIKE', "%{$keyword}%")
                         ->orWhere('email', 'LIKE', "%{$keyword}%");
        })->get();

        return view('admin.QuanLyTaiKhoan.index', compact('nguoiDungs', 'keyword'));
    }

    // Hiển thị form tạo người dùng mới (create)
    public function create()
    {
        return view('admin.QuanLyTrangTinTuc.themtrangtintuc');
    }

    // Lưu người dùng mới vào cơ sở dữ liệu (store)
    public function store(NguoiDungRequest $request)
    {
        // Prepare user data
        $data = $request->all();
        $data['mat_khau'] = Crypt::encrypt($request->mat_khau); // Encrypt the password

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public'); // Save avatar to avatars folder
            $data['avatar'] = $avatarPath; // Assign the avatar path to data
        }

        // Lấy vai trò từ request
        $vaiTro = $request->vai_tro;

        // Thiết lập prefix dựa trên vai trò
        $prefix = $vaiTro === 'Khách Hàng' ? 'KH-' : 'A-';

        // Lấy tour cuối cùng dựa trên vai trò và phần số của ma_tour
        $lastNguoiDung = NguoiDung::selectRaw("CAST(SUBSTRING(id, 3) AS UNSIGNED) as so_nguoi")
            ->where('id', 'like', $prefix . '%')
            ->orderBy('so_nguoi', 'desc')
            ->first();

        // Tính toán giá trị số thứ tự mới cho ma_tour
        $newNumber = $lastNguoiDung ? $lastNguoiDung->so_nguoi + 1 : 1;

        // Gán giá trị
        $data['id'] = $prefix . $newNumber;

        // Create new user
        NguoiDung::create($data);

        return redirect()->route('quanlytaikhoan')->with('success', 'Thêm tài khoản thành công!');
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'ho_ten' => 'required|max:100',
            'tai_khoan' => 'required|max:100',
            'so_dien_thoai' => 'required|max:20',
            'email' => 'required|email|max:50|unique:nguoi_dung,email,'.$id, // Ensure the email is unique except for the current user
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vai_tro' => 'required|max:50',
            'mat_khau' => 'nullable|min:6', // Allow the password to be optional
        ]);
    
        // Find the user
        $nguoiDung = NguoiDung::findOrFail($id);
    
        // Update user data
        $nguoiDung->ho_ten = $request->ho_ten;
        $nguoiDung->tai_khoan = $request->tai_khoan;
        $nguoiDung->so_dien_thoai = $request->so_dien_thoai;
        $nguoiDung->email = $request->email;
    
        // Update password if provided
        if ($request->filled('mat_khau')) {
            $nguoiDung->mat_khau = Crypt::encrypt($request->mat_khau);
        }
    
        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            if ($nguoiDung->avatar) {
                Storage::disk('public')->delete($nguoiDung->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $nguoiDung->avatar = $avatarPath;
        }
    
        // Update role
        $nguoiDung->vai_tro = $request->vai_tro;
    
        // Save the updated user
        $nguoiDung->save();
    
        return redirect()->route('quanlytaikhoan')->with('success', 'Cập nhật tài khoản thành công!');
    }

    // Xóa người dùng (destroy)
    public function destroy($id)
    {
        $nguoiDung = NguoiDung::findOrFail($id);

        if ($nguoiDung->avatar && $nguoiDung->avatar !== 'avatars/default.png') {
            Storage::disk('public')->delete($nguoiDung->avatar);
        } else if($nguoiDung->avatar == 'avatars/default.png'){
            $nguoiDung->delete($nguoiDung->avatar);
        }

        $nguoiDung->delete(); 
        
        return redirect()->route('quanlytaikhoan')->with('success', 'Xóa tài khoản thành công!');   
    }
}
