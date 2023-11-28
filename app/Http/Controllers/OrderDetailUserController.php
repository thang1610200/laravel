<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailUserController extends Controller
{
    //
    public function index (Request $request){
        $order_token = $request->query('orderId');
        $user = Auth::user();

        $order = Order::where([
            'token' => $order_token,
            'buyer_id' => $user->id
        ])->withTrashed()->first();

        if(!$order){
            return abort(403);
        }

        return view('user.payment_result',[
            'order' => $order
        ]);
    }
}
