<?php

namespace App\Http\Controllers;

use App\Models\SellTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchTicketController extends Controller
{
    //
    public function search (Request $request){
       //$ticket = SellTicket::where('slug','like',$request->input('slug').'%')->get();

        $ticket = DB::table('sell_tickets')
                    ->join('tickets','sell_tickets.ticket_id','=','tickets.id')
                    ->where('sell_tickets.slug','like',$request->input('slug').'%')
                    ->select('sell_tickets.slug','tickets.name')
                    ->get();

        return response()->json([
            'ticket' => $ticket,
        ], 200);
    }
}
