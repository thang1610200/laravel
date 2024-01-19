<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Jobs\SendEmailVerify;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //
    public function index () {
        return view('auth.register');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', "min:10"],
            'password' => ['required', Password::min(10)
                                                ->letters()
                                                ->mixedCase()
                                                ->numbers()
                                                ->symbols()],
            'confirm' => ['required', 'same:password'],
            'email' => ['required', 'email', 'unique:users']
        ]);
        Log::alert('test');

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->all()
            ],422);
        }

        $validate = $validator->validate();

        $token = Str::random(20);
        //$uuid = Str::uuid()->toString();
        $password = Hash::make($validate['password'],[
            'rounds' => 10
        ]);

        $user = new User();
        //$user->id = $uuid;
        $parts = explode('@', $validate['email']);
        $user->email = $validate['email'];
        $user->name = $validate['name'];
        $user->password = $password;
        $user->verify_code = $token;
        $user->link = Str::slug($parts[0],'-');
        $user->save();

        //
        $mailData = [
            'name' => $validate['name'],
            'url' => "http://localhost:3000/auth/verify?token=".$token."&email=".$validate['email']
        ];

        dispatch(new SendEmailVerify($validate['email'], $mailData));

        // toastr()->success('Login success!')
        //     ->warning('Check email to active account!');
        
        flash('Check email to active account!','warning');
    
        return response()->json([],200);
    }
}
