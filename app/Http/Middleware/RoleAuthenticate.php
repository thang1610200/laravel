<?php

namespace App\Http\Middleware;

use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuthenticate
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
        $slug = $request->route()->parameter('slug');

        $ticket = Ticket::where([
            'slug' => $slug
        ])->first();
        
        if(!$ticket || !Auth::check()){
            return abort(404);
        }

        $role = Auth::user()->role;

        $role = Auth::user()->role;

        if($role !== 'admin' && !$ticket->isSell){
            return abort(404);
        }

        $request['ticket'] = $ticket;
        return $next($request);
    }
}
