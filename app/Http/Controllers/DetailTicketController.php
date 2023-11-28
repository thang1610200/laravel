<?php

namespace App\Http\Controllers;

use App\Models\SellTicket;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DetailTicketController extends Controller
{
    //
    public function index ($slug) {
        $ticket = SellTicket::where([
            'slug' => $slug
        ])->first();
        
        if(!$ticket){
            return abort(404);
        }

        return view('user.detail-ticket',[
            'ticket' => $ticket
        ]);
    }
}
