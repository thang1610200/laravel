<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ManagementOrderAdminController extends Controller
{
    //
    public function index(){
        $order = Order::withTrashed()->get();

        return view('admin-lte.management-order', [
            "order" => $order
        ]);
    }
}
