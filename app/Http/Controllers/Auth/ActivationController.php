<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Backend;

class ActivationController extends Controller
{
    public function activate($token = null)
    {
        if($token) {

            $user = Backend::user('activation_key', $token);

            if($token == 'resend') {
    			# Resend the activation email
    			$user->SendActivationEmail();

    			# Redirect the user to the main page
                return redirect()->route('backend::activate_account')->with('success', trans('Backend.activation_email_sent'));

    		} else {

                if($user) {
                    if($user->active) {
                        return redirect()->route('backend::activate_account')->with('error', trans('Backend.activation_user_already_activated'));
                    } else {
                        $user->active = true;
        				$user->save();
                        return redirect()->route('backend::activate_account')->with('success', trans('Backend.activation_account_activated'));
                    }
                } else {
                    # Redirect the user back to the activation page
                    return redirect()->route('backend::activate_account')->with('error', trans('Backend.activation_not_valid'));
                }

            }

        } else {
            # Return the activation form
    		return view('auth/activate');
        }
    }

    public function activateWithForm(Request $request)
    {
    	# Validate Request
    	$this->validate($request, [
    		'token'	=> 'required',
		]);

    	# Get the token
    	$token = $request->input('token');

    	# Call the activate function
    	return $this->activate($token);
    }
}
