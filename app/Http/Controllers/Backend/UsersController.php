<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role_User;
use Backend;
use Auth;
use Gate;

class UsersController extends Controller
{

    public function index()
    {
        Backend::permissionToAccess('backend.users.access');

    	# Get all users
    	$users = Backend::users();
    	# Get the active users
    	$active_users = Backend::users('active', true);

    	# Get Banned Users
    	$banned_users = Backend::users('banned', true);

    	# Get all roles
    	$roles = Backend::roles();

    	# Return the view
    	return view('backend/users/index', [
    		'users' 		=> 	$users,
    		'roles'			=>	$roles,
    		'active_users'	=>	$active_users,
    		'banned_users'	=>	$banned_users,
		]);
    }

    public function show($id)
    {
        Backend::permissionToAccess('backend.users.access');

    	# Find the user
    	$user = Backend::user('id', $id);

    	# Return the view
    	return view('backend/users/show', ['user' => $user]);
    }

    public function create()
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.create');

        # Get all roles
        $roles = Backend::roles();

        # Get all the data
        $data_index = 'users';
        require('Data/Create/Get.php');

        # Return the view
        return view('backend/users/create', [
            'roles'     =>  $roles,
            'fields'    =>  $fields,
            'confirmed' =>  $confirmed,
            'encrypted' =>  $encrypted,
            'hashed'    =>  $hashed,
            'masked'    =>  $masked,
            'table'     =>  $table,
            'code'      =>  $code,
            'wysiwyg'   =>  $wysiwyg,
            'relations' =>  $relations,
        ]);
    }

    public function store(Request $request)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.create');

        # create the user
        $row = Backend::newUser();

        # Save the data
        $data_index = 'users';
        require('Data/Create/Save.php');

        # Setup a random activation key
        $row->activation_key = str_random(25);

        # Get the register IP
        $row->register_ip = $request->ip();

        # Activate the user if set
        if($request->input('active')){
            $row->active = true;
        }

        # Save the user
        $row->save();

        # Send welcome email if set
        if($request->input('mail')) {
            # Send Welcome email
            $row->sendWelcomeEmail($row);
        }

        # Send activation email if set
        if($request->input('send_activation')) {
            $row->sendActivationEmail($row);
        }

        $this->setRoles($row->id, $request);

        # Return the admin to the users page with a success message
        return redirect()->route('backend::users')->with('success', trans('backend.msg_user_created'));
    }

    public function edit($id)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.edit');

        # Find the user
        $row = Backend::user('id', $id);

        # Check if admin access
        Backend::mustNotBeAdmin($row);

        # Get all the data
        $data_index = 'users';
        require('Data/Edit/Get.php');

        # Return the view
        return view('backend/users/edit', [
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

    public function update($id, Request $request)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.edit');

        # Find the user
        $row = Backend::user('id', $id);

        # Check if admin access
        Backend::mustNotBeAdmin($row);

        # Save the data
        $data_index = 'users';
        require('Data/Edit/Save.php');

        # Return the admin to the users page with a success message
        return redirect()->route('backend::users')->with('success', trans('backend.msg_user_edited'));
    }

    public function editRoles($id)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.roles');

    	# Find the user
    	$user = Backend::user('id', $id);

        # Check if admin access
        Backend::mustNotBeAdmin($user);

    	# Get all roles
    	$roles = Backend::roles();

    	# Return the view
    	return view('backend/users/roles', ['user' => $user, 'roles' => $roles]);
    }

    public function setRoles($id, Request $request)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.roles');

		# Find the user
    	$user = Backend::user('id', $id);

        # Check if admin access
        Backend::mustNotBeAdmin($user);

    	# Get all roles
    	$roles = Backend::roles();

    	# Change user's roles
    	foreach($roles as $role) {

            $modify = true;

            # Check for su
            if($role->su) {
                $modify = false;
            }

            # Check if it's assignable
            if(!$role->assignable and !Backend::loggedInUser()->su) {
                $modify = false;
            }

            if($modify) {
                if($request->input($role->id)){
                    # The admin selected that role

                    # Check if the user was already in that role
                    if($this->checkRole($user->id, $role->id)) {
                        # The user is already in that role, so no change is made
                    } else {
                        # Add the user to the selected role
                        $this->addRel($user->id, $role->id);
                    }
                } else {
                    # The admin did not select that role

                    # Check if the user was in that role
                    if($this->checkRole($user->id, $role->id)) {
                        # The user is in that role, so as the admin did not select it, we need to delete the relationship
                        $this->deleteRel($user->id, $role->id);
                    } else {
                        # The user is not in that role and the admin did not select it
                    }
                }
            }
    	}

    	# Return Redirect
        return redirect()->route('backend::users')->with('success', trans('backend.msg_user_roles_edited'));
    }

    public function checkRole($user_id, $role_id)
    {
        Backend::permissionToAccess('backend.users.access');

    	# This function returns true if the specified user is found in the specified role and false if not

    	if(Role_User::whereUser_idAndRole_id($user_id, $role_id)->first()) {
    		return true;
    	} else {
    		return false;
    	}

    }

    public function deleteRel($user_id, $role_id)
    {
        Backend::permissionToAccess('backend.users.access');

    	$rel = Role_User::whereUser_idAndRole_id($user_id, $role_id)->first();
    	if($rel) {
    		$rel->delete();
    	}
    }

    public function addRel($user_id, $role_id)
    {
        Backend::permissionToAccess('backend.users.access');

    	$rel = Role_User::whereUser_idAndRole_id($user_id, $role_id)->first();
    	if(!$rel) {
    		$rel = new Role_User;
    		$rel->user_id = $user_id;
    		$rel->role_id = $role_id;
    		$rel->save();
    	}
    }

    public function destroy($id)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.delete');

        # Find The User
        $user = Backend::user('id', $id);

        # Check if admin access
        Backend::mustNotBeAdmin($user);

        # Check if it's su
        if($user->su) {
            abort(403, trans('backend.error_security_reasons'));
        }

    	# Check before deleting
    	if($id == Backend::loggedInUser()->id) {
            abort(403, trans('backend.error_user_delete_yourself'));
    	} else {

    		# Delete Relationships
    		$rels = Role_User::where('user_id', $user->id)->get();
    		foreach($rels as $rel) {
    			$rel->delete();
    		}

    		# Delete User
    		$user->delete();

    		# Return the admin with a success message
            return redirect()->route('backend::users')->with('success', trans('backend.msg_user_deleted'));
    	}
    }

    public function editSettings()
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.settings');

    	# Get the user settings
    	$row = Backend::userSettings();

        # Update the settings
        $data_index = 'users_settings';
        require('Data/Edit/Get.php');

    	return view('backend/users/settings', [
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

    public function updateSettings(Request $request)
    {
        Backend::permissionToAccess('backend.users.access');

        # Check permissions
        Backend::permissionToAccess('backend.users.settings');

    	# Get the user settings
    	$row = Backend::userSettings();

    	# Update the settings
        $data_index = 'users_settings';
        require('Data/Edit/Save.php');

    	# Return a redirect
        return redirect()->route('backend::users')->with('success', trans('backend.msg_user_update_settings'));
    }
}
