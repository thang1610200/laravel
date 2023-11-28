<?php

namespace App\Http\Controllers;

use App\Models\SellTicket;
use App\Http\Requests\StoreSellTicketRequest;
use App\Http\Requests\UpdateSellTicketRequest;

class SellTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSellTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellTicket  $sellTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SellTicket $sellTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellTicket  $sellTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SellTicket $sellTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellTicketRequest  $request
     * @param  \App\Models\SellTicket  $sellTicket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellTicketRequest $request, SellTicket $sellTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellTicket  $sellTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellTicket $sellTicket)
    {
        //
    }
}
