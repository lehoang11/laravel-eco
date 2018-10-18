<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Backend;
use URL;
use Auth;

class LocaleController extends Controller
{
    public function set($locale, Request $request)
    {
    	if (Auth::check()){
            $user = Backend::loggedInUser();
            $user->locale = $locale;
            $user->save();
    	} else {
            $request->session()->put('locale', $locale);
    	}
        return redirect(URL::previous());
    }
}
