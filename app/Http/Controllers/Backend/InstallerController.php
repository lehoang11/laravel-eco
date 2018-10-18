<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use Auth;
use Artisan;
use Backend;

class InstallerController extends Controller
{
    public function locale()
    {
        // Show the locale options
        if(!Backend::checkInstalled()){
            return view('backend/installer/locale');
        } else {
            return redirect()->route('backend::dashboard')->with('warning', trans('backend.already_installed'));
        }
    }

    public function show($locale)
    {
        // Show the installation form
        if(!Backend::checkInstalled()){
            // Set the locale
            App::setLocale($locale);


            return view('backend/installer/index');
        } else {
            return redirect()->route('backend::dashboard')->with('warning', trans('backend.already_installed'));
        }
    }

    public function installConfig($locale, Request $request)
    {
        if(!Backend::checkInstalled()){
            // Install Laralum

            $this->validate($request, [
                'USER_NAME' => 'required',
                'USER_PASSWORD' => 'required|min:6|confirmed',
                'USER_EMAIL' => 'required',
                'USER_COUNTRY_CODE' => 'required',
                'USER_LOCALE' => 'required',
                'ADMINISTRATOR_ROLE_NAME' => 'required',
                'DEFAULT_ROLE_NAME' => 'required',
                'DB_HOST' => 'required',
                'DB_PORT' => 'required',
                'DB_DATABASE' => 'required',
                'DB_USERNAME' => 'required',
            ]);

            $file_location = base_path() . '/.env';
            $env = fopen($file_location, "w") or die("Unable to open file!");
            foreach($request->all() as $key => $data) {
                if($key != '_token' and $key != 'USER_PASSWORD_confirmation') {
                    fwrite($env, $key . "='" . $data . "'\n");
                }
            }
            $default = "\nREDIS_HOST=127.0.0.1\nREDIS_PASSWORD=null\nREDIS_PORT=6379\n\nPUSHER_KEY=\nPUSHER_SECRET=\nPUSHER_APP_ID=\n\nBROADCAST_DRIVER=log\nCACHE_DRIVER=file\nSESSION_DRIVER=file\nQUEUE_DRIVER=sync\n\nAPP_ENV=local\nAPP_KEY=" . env('APP_KEY') . "\nAPP_DEBUG=true\nAPP_LOG_LEVEL=debug\nAPP_URL=" . url('/') . "\n";
            fwrite($env, $default);
            fclose($env);

            return redirect()->route('backend::install_confirm', ['locale' => $locale]);
        } else {
            return redirect()->route('backend::dashboard')->with('warning', trans('backend.already_installed'));
        }
    }

    public function install($locale)
    {
        if(!Backend::checkInstalled()){

            $exitCode = Artisan::call('migrate');

            if (Auth::attempt(['email' => env('USER_EMAIL'), 'password' => env('USER_PASSWORD')])) {
                // Authentication passed...

                $file_location = base_path() . '/.env';
                $default = "\nSTART_INSTALLED=true";
                file_put_contents($file_location,$default, FILE_APPEND);

                $url = route('backend::dashboard');
                return redirect()->intended($url)->with('success', trans('backend.welcome_to_backend'));
            } else{
                die("<b>ERROR: </b> Something went wrong, please post an issue about it on github");
            }
        } else{
            return redirect()->route('backend::dashboard')->with('warning', trans('backend.already_installed'));
        }
    }
}
