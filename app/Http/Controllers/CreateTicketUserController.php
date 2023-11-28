<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CreateTicketUserController extends Controller
{
    //
    public function index (){
        return view('user.create-ticket');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => ['required','min:1'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['file'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->all()
            ],422);
        }

        $validate = $validator->validate();

        // $image = "test.png";

        // $validate['image']->storeAs('/', $image, 'public');

        // dispatch(new UploadImage($image,$validate['name'], $validate['quantity'], $validate['price'], $validate['description'], Auth::user()->id));

        $response = cloudinary()->upload($validate['image']->getRealPath())->getSecurePath();

        $ticket = new Ticket();
        $ticket->name = $validate['name'];
        $ticket->quantity = $validate['quantity'];
        $ticket->price = $validate['price'];
        $ticket->description = $validate['description'];
        $ticket->image = $response;
        $ticket->slug = Str::slug($validate['name']);
        $ticket->seller_id = Auth::user()->id;

        $ticket->save();

        return response()->json([], 200);
    }
}
