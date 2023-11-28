<?php

namespace App\Http\Middleware;

use App\Models\SellTicket;
use Closure;
use Illuminate\Http\Request;

class CheckDetailTicket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ticket = SellTicket::where([
            'isSell' => 1,
            'isBrowse' => 1,
            'slug' => $request->route('slug')
        ])->first();

        if(!$ticket){
            abort(404);
        }

        return $next($request);
    }
}
