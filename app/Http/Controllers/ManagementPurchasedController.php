<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SellTicket;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ManagementPurchasedController extends Controller
{
    //
    public function index(Request $request) {
        if($request->query('type') === "unpaid"){
            $ticket = Order::where('buyer_id', Auth::user()->id)->withTrashed()->where('deleted_at', null)->get();
            return view('user.management-ticket-purchase',[
                'ticket' => $ticket
            ]);
        }
        else if(!$request->query('type')){
            $ticket = Order::where('buyer_id', Auth::user()->id)->onlyTrashed()->get();
            return view('user.management-ticket-purchase',[
                'ticket' => $ticket
            ]);
        }
    }

    public function getTicket(Request $request){
        $ticket_id = $request->query('ticket_id');
        $sellticket = SellTicket::where('id', $ticket_id)->first();

        return response()->json([
            'ticket' => $sellticket->ticket,
            'sellticket' => $sellticket
        ],200); 
    }

    public function store(Request $request){
        $order = Order::onlyTrashed()->where(
            ['buyer_id' => Auth::user()->id,
            'ticket_id' => $request->input('ticket_id')
            ])->first();

        if($request->input('quantity') > ($order->quantity - $order->quantity_sell)){
            return response()->json([],422);
        }

        Order::where([
            'buyer_id' => Auth::user()->id,
            'ticket_id' => $request->input('ticket_id')
        ])->onlyTrashed()->update(['quantity_sell' => $request->input('quantity')]);

        $sellticket = new SellTicket();
        $sellticket->slug = Str::slug($order->sellticket->ticket->slug.time());
        $sellticket->seller_id = Auth::user()->id;
        $sellticket->ticket_id = $order->sellticket->ticket->id;
        $sellticket->commission_id = $order->sellticket->commission_id;
        $sellticket->price = $request->input('price');
        $sellticket->quantity = $request->input('quantity');
        $sellticket->save();

        return response()->json([
        ],200);
    }
}
