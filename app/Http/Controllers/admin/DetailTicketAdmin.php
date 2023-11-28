<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SellTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DetailTicketAdmin extends Controller
{
    //
    public function index ($slug){
        $sell_ticket = SellTicket::where('slug',$slug)->first();

        return view('admin-lte.detail-ticket',[
            'sell_ticket' => $sell_ticket,
            'ticket' => $sell_ticket->ticket
        ]);
    }
}
