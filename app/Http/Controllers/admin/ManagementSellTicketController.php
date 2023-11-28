<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\SellTicket;
use Illuminate\Http\Request;

class ManagementSellTicketController extends Controller
{
    //
    public function index(){
        $ticket = SellTicket::all();

        return view('admin-lte.management-sell-ticket',[
            "ticket" => $ticket
        ]);
    }

    public function update(Request $request) {
        $sellticket_id = $request->input('sellticket_id');

        $sellticket = SellTicket::where('id', $sellticket_id)->first();

        $isSell = $sellticket->isSell === 0 ? 1 : 0;

        $result = SellTicket::where('id',$sellticket_id)->update(['isSell' => $isSell]);

        return response()->json([
            "data" => $sellticket->first()
        ],200);
    }

    public function updateBrowse(Request $request){
        $sellticket_id = $request->input('sellticket_id');

        $sellticket = SellTicket::where('id', $sellticket_id)->first();

        $isBrowse = $sellticket->isBrowse === 0 ? 1 : 0;

        $result = SellTicket::where('id',$sellticket_id)->update(['isBrowse' => $isBrowse]);

        return response()->json([
            "data" => $sellticket->first()
        ],200);
    }
}
