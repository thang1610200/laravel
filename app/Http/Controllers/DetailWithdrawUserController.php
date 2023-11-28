<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class DetailWithdrawUserController extends Controller
{
    //
    public function index($link){
        $withdraw = Withdraw::where('token', $link)->first();
        if(!$withdraw){
            return abort(404);
        }

        return view('admin-lte.detail-withdraw-user',[
            'withdraw' => $withdraw
        ]);
    }
}
