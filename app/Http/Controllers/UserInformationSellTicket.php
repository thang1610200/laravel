<?php

namespace App\Http\Controllers;

use App\Models\SellTicket;
use Illuminate\Http\Request;
use App\Models\User;

class UserInformationSellTicket extends Controller
{
    //
    public function index ($link) {
        $user = User::where('link',$link)->first();

        if(!$user){
            abort(404);
        }

        $sellticket = SellTicket::where('seller_id',$user->id)->get();

        return view('user.user-information',[
            'user' => $user,
            'ticket' => $sellticket
        ]);
    }
}
