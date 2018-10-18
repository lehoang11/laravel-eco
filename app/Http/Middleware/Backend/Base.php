<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Auth;
use Backend;
use App;

class Base
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
            # Check if the user is activated
            if(Auth::check()) {

                $user = Backend::loggedInuser();

                if(!$user->active) {
                    if(Backend::currentURL() != url('/logout')) {
                        if (strpos(Backend::currentURL(), route('backend::activate_form')) !== false) {
                            // Seems to be ok
                        } else {
                            return redirect()->route('backend::activate_form');
                        }
                    }

                }

                if($user->banned and Backend::currentURL() != route('backend::banned')) {
                    if(Backend::currentURL() != url('/logout')) {
                        return redirect()->route('backend::banned');
                    }
                }

                # Set App Locale
                if($user->locale) {
                    App::setLocale($user->locale);
                }

            } else {
                if ($request->session()->has('locale')) {
                	App::setLocale(session('locale'));
                }
            }
        }

        return $next($request);
    }
}
