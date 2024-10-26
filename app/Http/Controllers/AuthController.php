<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login-register');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('login-register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'ho_ten' => 'required|max:100',
            'tai_khoan' => 'required|max:100|unique:nguoi_dung,tai_khoan',
            'mat_khau' => 'required|min:8',
            'so_dien_thoai' => 'required|unique:nguoi_dung,so_dien_thoai|max:20',
            'email' => 'required|email|unique:nguoi_dung,email|max:50',
        ]);

        // Find the last user with an ID in the 'KH-<number>' format
        $lastUser = NguoiDung::where('id', 'LIKE', 'KH-%')
                    ->orderBy('id', 'desc')
                    ->first();

        if ($lastUser) {
            $lastIdNumber = (int)str_replace('KH-', '', $lastUser->id);
            $newId = 'KH-' . ($lastIdNumber + 1);
        } else {
            $newId = 'KH-1';
        }

        NguoiDung::create([
            'id' => $newId,
            'ho_ten' => $request->ho_ten,
            'tai_khoan' => $request->tai_khoan,
            'mat_khau' => Crypt::encrypt($request->mat_khau),
            'so_dien_thoai' => $request->so_dien_thoai,
            'email' => $request->email,
            'avatar' => '',
            'vai_tro' => 'Khách Hàng',
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    // Đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'tai_khoan' => 'required|string',
            'mat_khau' => 'required|string',
        ]);

        // Tìm người dùng theo tài khoản
        $user = NguoiDung::where('tai_khoan', $request->tai_khoan)->first();

        // Kiểm tra nếu người dùng tồn tại
        if ($user) {
            try {
                // Giải mã mật khẩu từ CSDL
                $decryptedPassword = Crypt::decrypt($user->mat_khau);

                // Kiểm tra xem mật khẩu người dùng nhập vào có khớp với mật khẩu đã giải mã không
                if ($request->mat_khau === $decryptedPassword) {
                    Auth::login($user); // Đăng nhập người dùng
                    if ($user->vai_tro === 'admin' || $user->vai_tro === 'Nhân Viên Quản Lý Website' 
                            || $user->vai_tro === 'Nhân Viên Chăm Sóc Khách Hàng' 
                                || $user->vai_tro === 'Nhân Viên Thống Kê') {
                        return redirect()->route('bangdieukhien')->with('success', 'Đăng nhập thành công với quyền Nhân Viên Quản Lý Website!');
                    } else if ($user->vai_tro === 'Khách Hàng') {
                        return redirect()->route('homepage')->with('success', 'Đăng nhập thành công với quyền người dùng!');
                    }
                }
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return back()->withErrors([
                    'tai_khoan' => 'Tài khoản hoặc mật khẩu không chính xác.',
                ]);
            }
        }

        return back()->withErrors([
            'tai_khoan' => 'Tài khoản hoặc mật khẩu không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng

        // Đưa người dùng trở về trang đăng nhập với thông báo
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    // Thông Tin Cá Nhân Admin
    public function showProfile()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();
        
        // Trả về view với thông tin người dùng
        return view('auth.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
            // Thêm các quy tắc xác thực khác nếu cần
        ]);

        $user = Auth::user();
        $user->ho_ten = $request->ho_ten;
        $user->email = $request->email;
        $user->so_dien_thoai = $request->so_dien_thoai;

        // Lưu ảnh đại diện nếu có
        if ($request->hasFile('avatar')) {
            // Xử lý lưu ảnh
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('thong_tin_ca_nhan')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function showChangePasswordForm()
    {
        return view('auth.doi_mat_khau');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'mat_khau_cu' => 'required|string',
            'mat_khau_moi' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Crypt::encryptString($request->mat_khau_cu, $user->mat_khau)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu cũ không chính xác.']);
        }

        // Cập nhật mật khẩu mới
        $user->mat_khau = Crypt::encrypt($request->mat_khau_moi); 
        $user->save();

        return redirect()->route('thong_tin_ca_nhan')->with('success', 'Đổi mật khẩu thành công!');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng

        // Đưa người dùng trở về trang đăng nhập với thông báo
        return redirect()->route('homepage')->with('success', 'Đăng xuất thành công!');
    }

    // Thông Tin Cá Nhân User
    public function showProfileUser()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();
        
        // Trả về view với thông tin người dùng
        return view('auth.user.profile', compact('user'));
    }

    public function editUser()
    {
        $user = Auth::user();
        return view('auth.user.edit-profile', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
            // Thêm các quy tắc xác thực khác nếu cần
        ]);

        $user = Auth::user();
        $user->ho_ten = $request->ho_ten;
        $user->email = $request->email;
        $user->so_dien_thoai = $request->so_dien_thoai;

        // Lưu ảnh đại diện nếu có
        if ($request->hasFile('avatar')) {
            // Xử lý lưu ảnh
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('thong_tin_ca_nhan_user')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function showChangePasswordFormUser()
    {
        return view('auth.user.doi_mat_khau');
    }

    public function changePasswordUser(Request $request)
    {
        $request->validate([
            'mat_khau_cu' => 'required|string',
            'mat_khau_moi' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Crypt::encryptString($request->mat_khau_cu, $user->mat_khau)) {
            return back()->withErrors(['mat_khau_cu' => 'Mật khẩu cũ không chính xác.']);
        }

        // Cập nhật mật khẩu mới
        $user->mat_khau = Crypt::encrypt($request->mat_khau_moi); 
        $user->save();

        return redirect()->route('thong_tin_ca_nhan_user')->with('success', 'Đổi mật khẩu thành công!');
    }

    public function dieuHuongDenGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function xuLyGoogle()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $lastUser = NguoiDung::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_nguoi")
        ->where('id', 'like', 'KH-%')
        ->orderBy('so_nguoi', 'desc')
        ->first();

        // Tính toán giá trị số thứ tự mới cho `id`
        $newNumber = $lastUser ? $lastUser->so_nguoi + 1 : 1;
        $newId = 'KH-' . $newNumber;

        $user = NguoiDung::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'id' => $newId,
                'ho_ten' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'vai_tro' => 'Khách Hàng',
                'dang_nhap_qua' => 'email',
            ]
        );

        Auth::login($user, true);

        return redirect()->route('homepage'); // Điều hướng đến trang chủ hoặc trang khác sau khi đăng nhập thành công
    }

}
