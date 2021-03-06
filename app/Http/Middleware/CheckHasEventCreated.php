<?php

namespace App\Http\Middleware;

use App\Services\EventsUserService;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckHasEventCreated
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


        $eventUser = new EventsUserService();

        $count = $eventUser->listByUser(Auth::id());
        if (!$count->count() && !$request->routeIs(['events.*'])) {
            return redirect()->to(route('events.create'));
        }

        return $next($request);
    }
}
