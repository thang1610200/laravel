<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginAdminController extends Controller
{
    //
    public function index () {
        return view('admin-lte.login');
    }

    public function store (Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $rememeber = $request->input('remember');

        //$user = User::where('email', $email)->first();

        if(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'admin'],$rememeber)){    // xác thực người dùng
            //toastr()->success('Login success!');
            $request->session()->regenerate();
            flash('Login success!','success');

            return response()->json([],200);
        }

        return response()->json([],401);
    }
}
