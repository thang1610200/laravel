<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SellTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    //
    public function create(Request $request){
        $quantity = $request->input('quantity');
        $id_user = Auth::user()->id;
        $ticket_slug = $request->input('slug');
        $token = Str::random(10);
        $ticket = SellTicket::where('slug', $ticket_slug)->first();

        if($ticket->quantity - $ticket->sold <= 0){
            return response()->json([],422);
        }
        else if(($ticket->quantity - $ticket->sold) < $quantity){
            return response()->json([],400);
        }

        $seller_id = $ticket->seller_id ? $ticket->seller_id : null;

        $total = $ticket->price * $quantity;
        $order = new Order();
        $order->token = $token;
        $order->ticket_id = $ticket->id;
        $order->buyer_id = $id_user;
        $order->seller_id = $seller_id;
        $order->quantity = $quantity;
        $order->total = $total;

        $order->save();

        return response()->json([
            'token' =>  $token
        ], 200);
    }
}
