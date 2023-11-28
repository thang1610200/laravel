<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Jobs\SendEmailResetPassword;

class ForgotPasswordController extends Controller
{
    //
    public function index(){
        return view('auth.forgot-password');
    }

    public function store(Request $request){
        $email = $request->input('email');

        $user = User::query()->where([
            'email' => $email,
        ]);
    
        if($user->get()->count() === 0){
            return response()->json([], 401);
        }


       $reset_password = DB::table('reset_passwords')->max('created_at');
       if((strtotime(now()) - strtotime($reset_password)) / 60 <= 5){
            return response()->json([],403);
       }

        $token = Str::random(30);
        $uuid = Str::uuid()->toString();
        $reset = new ResetPassword();
        $reset->id = $uuid;
        $reset->email = $email;
        $reset->token = $token;
    
        $reset->save();
    
        $mailData = [
            'name' => $user->get()[0]->name,
            'url' => "http://localhost:3000/auth/reset?token=".$token."&email=".$email
        ];
    
        dispatch(new SendEmailResetPassword($email, $mailData));
    
        //toastr()->info('Check email!');
        flash('Check email!','info');
    
        return response()->json([],200);
    }
}
