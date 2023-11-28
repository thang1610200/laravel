<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pay;
use App\Models\SellTicket;
use App\Models\Ticket;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResultCheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        $order_token = $request->vnp_TxnRef;
        $order_total = $request->vnp_Amount / 100;

        $order = Order::where('token', $order_token)->first();

        if (!$order) {
            return abort(403);
        }

        if($request->vnp_ResponseCode === '00'){
            DB::beginTransaction();
            try {
                // $sell_ticket = SellTicket::where('id', $order->ticket_id)->first();

                // SellTicket::where('id', $order->ticket_id)->update([
                //     'sold' => ($order->quantity + $sell_ticket->sold)
                // ]);
    
                $pay = new Pay();
    
                //if ($order->sellticket->seller_id) {
                    $pay->order_id = $order->id;
                    $pay->amount_from_buyer = $order_total;
                    $pay->amount_to_seller =  $order_total - ($order_total * $order->sellticket->commission->cost) / 100;
                    $pay->amount_to_ht = ($order_total * $order->sellticket->commission->cost) / 100;
                    $pay->save();
    
                    User::where('id', $order->sellticket->seller_id)->update([
                        'amount' => $order_total - ($order_total * $order->sellticket->commission->cost) / 100
                    ]);
                // } else {
                //     $pay->order_id = $order->id;
                //     $pay->amount_from_buyer = $order_total;
                //     $pay->amount_to_seller =  0;
                //     $pay->amount_to_ht = $order_total;
                //     $pay->save();
                // }
    
                Order::where('token', $order_token)->delete();
    
                DB::commit(); // xác nhận hoàn thành
            } catch (Exception $e) {
                DB::rollBack();  // thực hiện lại
                throw new Exception($e->getMessage());
            }

            return redirect('/user/order-detail?orderId='.$order_token);
        }
        else {
            $sell_ticket = SellTicket::where('id', $order->ticket_id)->first();

            SellTicket::where('id', $order->ticket_id)->update([
                'sold' => ($sell_ticket->sold - $order->quantity)
            ]);

            return redirect("/");
        }

    }
}
