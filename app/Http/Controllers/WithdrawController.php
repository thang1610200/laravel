<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    //
    public function index () {
        $withdraw = Withdraw::where('user_id', Auth::user()->id)->get();

        return view('user.withdraw', [
            "withdraw" => $withdraw
        ]);
    }
}
