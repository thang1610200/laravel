<?php

namespace App\Http\Controllers;

use App\Models\SellTicket;
use App\Models\User;
use Illuminate\Http\Request;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class HomeController extends Controller
{
    //

    public function index (Request $request) {
        //$priceMax = Ticket::max('price');
        $priceMax = SellTicket::where([
            'isSell' => 1,
            'isBrowse' => 1
        ])->max('price');

        $max = $request->query('max');
        $min = $request->query('min');
        $link = $request->query('name');

        $user = User::where('link',$link)->first();

        if($request->query('name')){
            if($request->query('sort')){
                $sort = $request->query('sort') === "low" ? 'asc' : 'desc';
    
                if($max !== null && $min !== null){
                    $ticket = SellTicket::where([
                                        'isSell' => 1,
                                        'isBrowse' => 1
                                    ])
                                    ->where('price','>=',$min)
                                    ->where('price','<=',$max)->where('seller_id',$user->id)->orderBy('price',$sort)->paginate(6);
                }
                else {
                    $ticket = SellTicket::where([
                        'isSell' => 1,
                        'isBrowse' => 1
                    ])->where('seller_id',$user->id)->orderBy('price',$sort)->paginate(6);
                }
            }
            else{
                if($max !== null && $min !== null){
                    // $ticket = Ticket::where('isSell',1)
                    //                 ->where('price','>=',$min)
                    //                 ->where('price','<=',$max)->paginate(6);
                    $ticket = SellTicket::where([
                                    'isSell' => 1,
                                    'isBrowse' => 1
                                ])
                                ->where('price','>=',$min)
                                ->where('price','<=',$max)->where('seller_id',$user->id)->paginate(6);
                }
                else {
                    $ticket = SellTicket::where([
                        'isSell' => 1,
                        'isBrowse' => 1
                    ])->where('seller_id',$user->id)->paginate(6);
                }
            }
        }
        else{
            if($request->query('sort')){
                $sort = $request->query('sort') === "low" ? 'asc' : 'desc';
    
                if($max !== null && $min !== null){
                    $ticket = SellTicket::where([
                                        'isSell' => 1,
                                        'isBrowse' => 1
                                    ])
                                    ->where('price','>=',$min)
                                    ->where('price','<=',$max)->orderBy('price',$sort)->paginate(6);
                }
                else {
                    $ticket = SellTicket::where([
                        'isSell' => 1,
                        'isBrowse' => 1
                    ])->orderBy('price',$sort)->paginate(6);
                }
            }
            else{
                if($max !== null && $min !== null){
                    // $ticket = Ticket::where('isSell',1)
                    //                 ->where('price','>=',$min)
                    //                 ->where('price','<=',$max)->paginate(6);
                    $ticket = SellTicket::where([
                                    'isSell' => 1,
                                    'isBrowse' => 1
                                ])
                                ->where('price','>=',$min)
                                ->where('price','<=',$max)->paginate(6);
                }
                else {
                    $ticket = SellTicket::where([
                        'isSell' => 1,
                        'isBrowse' => 1
                    ])->paginate(6);
                }
            }
        }

        if(request()->ajax()){
            return response()->json([
                'html' => view('ticket-all', [
                    'ticket' => $ticket
                ])->render(),
                'pagination' => view('pagination', [
                    'ticket' => $ticket
                ])->render()
            ]);
        }

        return view('home', [
            'ticket' => $ticket,
            'price' => $priceMax,
        ]);
    }

}
