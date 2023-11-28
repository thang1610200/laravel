<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdraw;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateRequestWithdraw extends Controller
{
    //
    public function index (){
        return view('user.create-request-withdraw');
    }

    public function store (Request $request){
        $username = $request['username'];
        $cccd = $request['cccd'];
        $stk = $request['stk'];
        $bank = $request['bank'];
        $money = $request['money'];
        $image_front = $request['image_front'];
        $image_behind = $request['image_behind'];
        $sdt = $request['sdt'];

        if($money > Auth::user()->amount){
            return response()->json([
                'messsage' => "Error"
            ],400);
        }


        try {
            DB::beginTransaction();

            $response_front = cloudinary()->upload($image_front->getRealPath())->getSecurePath();
            $response_behind = cloudinary()->upload($image_behind->getRealPath())->getSecurePath();

           // Log::alert("Before ".Auth::user()->amount);

            User::where('email', Auth::user()->email)->update([
                'name' => $username,
                'amount' => (Auth::user()->amount - $money)
            ]);
    
            $withdraw = new Withdraw();
            $withdraw->user_id = Auth::user()->id;
            $withdraw->total = $money;
            $withdraw->status = "Processing";
            $withdraw->token = time();
            $withdraw->stk = $stk;
            $withdraw->phone = $sdt;
            $withdraw->cccd = $cccd;
            $withdraw->bank = $bank;
            $withdraw->cccd_front = $response_front;
            $withdraw->cccd_behind = $response_behind;

            $withdraw->save();

            DB::commit();
        }
        catch(Exception $e){
            //Log::alert("After ".Auth::user()->amount);
            DB::rollBack(); 
            return response()->json([
                'error' => $e
            ], 500);
        }

        return response()->json([],200);
    }
}
