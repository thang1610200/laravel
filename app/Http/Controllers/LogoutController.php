<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate(); // làm mất hiệu lực phiên của người dùng, có nghĩa là tất cả dữ liệu được lưu trữ trong phiên của người dùng sẽ bị xóa
     
        $request->session()->regenerateToken(); //tạo lại mã thông báo CSRF cho phiên của người dùng để tránh các cuộc tấn công
     
        return redirect('/auth/login');
    }
}
