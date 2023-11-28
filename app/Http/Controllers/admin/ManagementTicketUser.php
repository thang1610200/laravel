<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class ManagementTicketUser extends Controller
{
    public function index($link) {
        $user = User::where('link', $link)->first();

        if(!$user){
            abort(404);
        }

        return view('admin-lte.ticket-user', [
            'user' => $user
        ]);
    }
}
