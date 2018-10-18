<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Backend;


class ProfileController extends Controller
{
    /**
     * Show the profile edit page
     */
    public function edit()
    {
        $row = Backend::loggedInUser();
        # Get all the data
        $data_index = 'profile';
        require('Data/Edit/Get.php');

        return view('backend/profile/index', [
            'row'       =>  $row,
            'fields'    =>  $fields,
            'confirmed' =>  $confirmed,
            'empty'     =>  $empty,
            'encrypted' =>  $encrypted,
            'hashed'    =>  $hashed,
            'masked'    =>  $masked,
            'table'     =>  $table,
            'code'      =>  $code,
            'wysiwyg'   =>  $wysiwyg,
            'relations' =>  $relations,
        ]);
    }


    /**
     * Update the user profile
     *
     * @param $request
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'image'             => 'image|max:5120',
            'current_password'  => 'required',
        ]);

        $row = Backend::loggedInUser();


        if (Hash::check($request->current_password, $row->password )){
            # Password correct, setup the new password and redirect with confirmation

            # Save the data
            $data_index = 'profile';
            require('Data/Edit/Save.php');
            if(array_key_exists('image', $request->all())){
                $request->file('image')->move('avatars', md5($row->email));
            }

            return redirect()->route('backend::profile')->with('success', trans('backend.profile_updated'));
        } else {
            # Password not correct, redirect back with error
            return redirect()->route('backend::profile')->with('error', trans('backend.incorrect_password'));
        }
    }
}
