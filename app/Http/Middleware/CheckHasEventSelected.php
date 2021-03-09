<?php

namespace App\Http\Middleware;

use App\Services\EventsUserService;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckHasEventSelected
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

        if (!Auth::user()->selected_event && !$request->routeIs(['events.*'])) {
            return redirect()->to(route('events.index'));
        }

        return $next($request);
    }
}
