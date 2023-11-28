<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\SellTicket;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    //
    public function index () {
        $user = User::where('role', 'user')->count();
        $order = Order::onlyTrashed()->count();
        $ticket_quantity = SellTicket::where([
            'isBrowse' => '1',
            'isSell' => 1
        ])->sum('quantity');

        $ticket_sold = SellTicket::where([
            'isBrowse' => '1',
            'isSell' => 1
        ])->sum('sold');

        return view('admin-lte.home',[
            "user" => $user,
            "order" => $order,
            "ticket_buy" => $ticket_quantity - $ticket_sold,
            "ticket_sold" => $ticket_sold
        ]);
    }
}
