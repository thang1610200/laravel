<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\SellTicket;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketAdminController extends Controller
{
    //
    public function index () {
        $ticket = Ticket::all()->sortDesc();
        $commission = Commission::all();

        return view('admin-lte.management-ticket',[
           'ticket' => $ticket,
           'commission' => $commission
        ]);
    }

    public function sell (Request $request) {
        $ticket_id = $request->input('ticket_id');
        $commisson_name = $request->input('commission');

        $commisson = Commission::where('name', $commisson_name)->first();
        $ticket = Ticket::where('id', $ticket_id)->first();
        DB::beginTransaction();

        try {
            Ticket::where('id', $ticket_id)->update([
                'isBrowse' => 1
            ]);

            $sellticket = new SellTicket();
            $sellticket->slug = $ticket->slug;
            $sellticket->ticket_id = $ticket_id;
            $sellticket->commission_id = $commisson->id;
            $sellticket->price = $ticket->price;
            $sellticket->quantity = $ticket->quantity;
            $sellticket->isSell = 1;
            $sellticket->isBrowse = 1;

            if($ticket->seller->role === 'user'){
                $sellticket->seller_id = $ticket->seller_id;
            }

            $sellticket->save();

            DB::commit();
    
            return response()->json([],200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([],500);
        }
    }

    public function getTicket (Request $request){
       $ticket_id = $request->query('ticket_id');

       $ticket = Ticket::where('id',$ticket_id)->first();

        return response()->json([
            "data" => $ticket
        ]);
    }
}
