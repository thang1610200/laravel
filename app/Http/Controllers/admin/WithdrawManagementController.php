<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawManagementController extends Controller
{
    //
    public function index () {
        $withdraw = Withdraw::all();

        return view('admin-lte.withdraw-management', [
            "withdraw" => $withdraw
        ]);
    }

    public function store (Request $request){
        $withdrawId = $request['withdrawId'];
        $status = $request['status'];

        $withdraw = Withdraw::where('id', $withdrawId)->first();

        if($status === 'Cancel'){
            User::where('email', $withdraw->user->email)->update([
                'amount' => ($withdraw->user->amount + $withdraw->total)
            ]);
        }

        Withdraw::where('id', $withdrawId)->update([
            'status' => $status
        ]);

        return response()->json([],200);
    }
}
