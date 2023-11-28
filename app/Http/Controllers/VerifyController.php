<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerifyController extends Controller
{
    //
    public function index (Request $request) {
                //
        $user = User::query()->where([
            'email' => $request->query('email'),
            'verify_code' => $request->query('token')
        ]);

        if($user->get()->count() !== 0 && !$user->get()[0]->getAttribute('email_verified_at')){
            $user->update([
                'email_verified_at' => now()
            ]);

            return redirect('/auth/login');
        }

        return view('error.status',[
            'status_code' => 403,
            'status_name' => 'Forbidden'
        ]);
    }
}
