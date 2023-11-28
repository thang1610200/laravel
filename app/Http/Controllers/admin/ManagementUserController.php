<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    //
    public function index(){
        $user = User::all();

        return view('admin-lte.management-user',[
            'user' => $user
        ]);
    }
}
