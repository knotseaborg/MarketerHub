<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Invite;

class SenderInviteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $invite = Invite::find($request->id);
        if($invite->sender_id != Auth::id()){
            return redirect()->route('denied');
        }
        return $next($request);
    }
}
