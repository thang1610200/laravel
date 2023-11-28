<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterAdminController extends Controller
{
    //
    public function index() {
        return view('admin-lte.register');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', "min:10"],
            'password' => ['required'],
            'confirm' => ['required', 'same:password'],
            'email' => ['required', 'email', 'unique:users']
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->all()
            ],422);
        }

        $validate = $validator->validate();

        $password = Hash::make($validate['password'],[
            'rounds' => 10
        ]);

        $user = new User();
        $parts = explode('@', $validate['email']);
        $user->email = $validate['email'];
        $user->name = $validate['name'];
        $user->password = $password;
        $user->link = Str::slug($parts[0],'-');
        $user->role = 'admin';
        $user->save();
        
        flash('Register Success!','success');
    
        return response()->json([],200);
    }
}
