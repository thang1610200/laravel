<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //
    public function index (Request $request){
        $token = $request->query('token');
        $email = $request->query('email');

        $link = ResetPassword::where([
            'email' => $email,
            'token' => $token
        ])->first();

        if(!$link || (strtotime(now()) - strtotime($link->created_at)) / 60 > 5 || $link->deleted_at){
            return view('error.status',[
                'status_code' => 403,
                'status_name' => 'Forbidden'
            ]);
        }

        return view('auth.reset-password',[
            'email' => $email
        ]);
    }

    public function store (Request $request){
        $token = $request->query('token');
        $email = $request->query('email');

        $link = ResetPassword::where([
            'email' => $email,
            'token' => $token
        ])->first();

        $user = User::where('email',$email)->first();

        if(!$link){
            return response()->json([],403);
        }

        if((strtotime(now()) - strtotime($link->created_at)) / 60 > 5 || $link->deleted_at){
           // toastr()->info('Please resend your email!');
            flash('Please resend your email!','info');
            return response()->json([],403);
        }

        if(Hash::check($request->input('password'),$user->password)){
            return response()->json([],400);
        }

        $password = Hash::make($request->input('password'),[
            'rounds' => 10
        ]);

        User::where('email',$email)->update([
            'password' => $password
        ]);

        ResetPassword::where('email',$email)->delete();

        //toastr()->success('Reset password success!');
        flash('Reset password success!','success');
        return response()->json([],200); 
    }
}
