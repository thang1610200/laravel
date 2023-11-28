<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommissionAdminController extends Controller
{
    //
    public function index () {
        return view('admin-lte.commission');
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:commissions'],
            'price' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->all()
            ],422);
        }

        $validate = $validator->validate();

        $commission = new Commission();
        $commission->name = $validate['name'];
        $commission->cost = $validate['price'];

        $commission->save();

        return response()->json([],201); 
    }
}
