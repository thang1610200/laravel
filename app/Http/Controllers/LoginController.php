<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index () {
        return view('auth.login');
    }

    public function store (Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $rememeber = $request->input('remember');

        $user = User::where('email', $email)->first();

        if($user && !$user->email_verified_at){
            return response()->json([
                'verify' => 'Please check your email to confirm'
            ],200); 
        }

        if(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'user'],$rememeber)){    // xác thực người dùng
            //toastr()->success('Login success!');
            $request->session()->regenerate();
            flash('Login success!','success');

            return response()->json([],200);
        }

        return response()->json([],401);
    }
}
