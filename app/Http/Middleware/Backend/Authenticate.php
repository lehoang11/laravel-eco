<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Auth;
use Backend;

class Authenticate
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
        if(Backend::checkInstalled()) {
            if(Auth::check()) {
                Backend::mustBeAdmin(Backend::loggedInUser());
            } else {
                return redirect('/')->with('error', 'You are not logged in');
            }
        }
        return $next($request);
    }
}
