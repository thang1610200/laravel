<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DetailOrderAdmin extends Controller
{
    //
    public function index ($order_token){
        $order = Order::where('token', $order_token)->withTrashed()->first();
        
        if(!$order){
            abort(404);
        }

        return view('admin-lte.detail-order',[
            'order' => $order
        ]);
    }
}
