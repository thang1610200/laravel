<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SellTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManagementSellTicketUserController extends Controller
{
    //
    public function index(){
        $ticket = SellTicket::where('seller_id',Auth::user()->id)->get();

        return view('user.management-ticket-sell',[
            'ticket' => $ticket
        ]);
    }

    public function store(Request $request){
        // $order = Order::where(
        //     ['buyer_id' => Auth::user()->id,
        //     'ticket_id' => $request->input('ticket_id')
        //     ])->onlyTrashed()->first();

        // $sellticket = new SellTicket();
        // $sellticket->slug = Str::slug($order->sellticket->ticket->slug.time());
        // $sellticket->seller_id = Auth::user()->id;
        // $sellticket->ticket_id = $request->input('ticket_id');
        // $sellticket->price = $request->input('price');
        // $sellticket->quantity = $request->input('quantity');
        // $sellticket->save();

        // return response()->json([],200);
    }
}
