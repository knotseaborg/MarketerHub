<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Invite;

class ReceiverInviteAccess
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
        if($invite->receiver_id != Auth::id()){
            return redirect()->route('invite.denied');
        }
        return $next($request);
    }
}
